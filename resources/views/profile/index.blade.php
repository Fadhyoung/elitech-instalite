<x-app-layout>
    <div class="py-4 flex flex-col min-h-screen bg-white">

        <!-- PROFILE HEADER -->
        @include('profile.partials.profile-bar')

        <!-- TAB FEEDS -->
        <div
            x-data="modalData(@js($feeds))"
            class="w-full max-w-4xl mx-auto mt-10">

            <!-- NAVIGATION -->
            <div class="flex w-full justify-center border-b">
                <button
                    @click="activeTab = 'posts'"
                    :class="activeTab === 'posts' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-view-grid class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Posts</span>
                </button>
                <button
                    @click="activeTab = 'archived'"
                    :class="activeTab === 'archived' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-bookmark class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Archived</span>
                </button>
                <button
                    @click="activeTab = 'tagged'"
                    :class="activeTab === 'tagged' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-hashtag class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Tagged</span>
                </button>
            </div>

            @if ($feeds && $feeds->isNotEmpty())

            <div x-show="activeTab === 'posts'">
                @include('profile.partials.posts-tab', ['feeds' => $feeds])
            </div>

            <div x-show="activeTab === 'archived'">
                @include('profile.partials.archived-tab', ['feeds' => $feeds])
            </div>

            <div x-show="activeTab === 'tagged'" class="w-full py-5 text-center">
                <p>On progress...</p>
            </div>

            @else
            <div class="mt-8 px-4">
                <div x-show="activeTab === 'posts'" class="flex flex-col items-center justify-center text-center py-8">
                    <form method="POST" action="{{ route('feeds.store') }}" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <input
                            type="file"
                            name="media_path"
                            accept="image/*,video/*"
                            class="hidden"
                            id="mediaInput"
                            onchange="document.getElementById('uploadForm').submit();">

                        <div class="w-fit border border-gray-300 rounded-full p-4 mb-4 justify-self-center">
                            <x-iconoir-camera class="h-8 w-8 text-gray-900" />
                        </div>

                        <h3 class="text-2xl font-bold mb-2">Share Photos</h3>
                        <p class="text-gray-600 text-center mb-4">
                            When you share photos, they will appear on your profile.
                        </p>

                        <button
                            type="button"
                            class="text-blue-500 font-semibold"
                            onclick="document.getElementById('mediaInput').click();">
                            Share your first photo
                        </button>
                    </form>

                </div>

                <div x-show="activeTab === 'saved'" class="flex flex-col items-center justify-center py-8">
                    <h3 class="text-xl font-bold mb-2">Saved</h3>
                    <p class="text-gray-600 text-center">Save photos and videos that you want to see again.</p>
                </div>

                <div x-show="activeTab === 'tagged'" class="flex flex-col items-center justify-center py-8">
                    <h3 class="text-xl font-bold mb-2">Tagged</h3>
                    <p class="text-gray-600 text-center">When people tag you in photos, they'll appear here.</p>
                </div>
            </div>
            @endif

            {{-- Footer --}}
            <footer class="mt-auto py-8 text-xs text-gray-500">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mb-4">
                        @foreach (['Fanuhi','About','Blog','Jobs','Help','API','Privacy','Terms','Locations','Instalite Fat','Threads','Contact Uploading & Non-Users','Fanuhi Verified','Fanuhi in Indonesia'] as $item)
                        <a href="#" class="hover:underline">{{ $item }}</a>
                        @endforeach
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <select class="bg-transparent text-gray-500 text-xs border-none focus:ring-0">
                            <option>English</option>
                        </select>
                        <span>Inspired by Instagram</span>
                        <span>© 2025 Instalite from Fanuhi</span>
                    </div>
                </div>
            </footer>

            <!-- FEED MODAL -->
            @include('profile.partials.feed-modal')

            <!-- MODAL NOTIF -->
            <div x-show="notification" x-transition x-text="notification"
                class="fixed top-4 right-4 bg-black text-white px-4 py-2 rounded shadow"
                x-cloak></div>


            <!-- ALPINEJS CONFIG -->
            <script>
                function modalData(initialFeeds) {
                    return {
                        showModal: false,
                        activeTab: 'posts',
                        selectedFeed: null,
                        feeds: initialFeeds,
                        notification: '',
                        comment: '',

                        showNotification(message) {
                            this.notification = message;
                            setTimeout(() => this.notification = '', 3000);
                        },

                        openModal(feed) {
                            fetch(`/feeds/${feed.id}`)
                                .then(res => res.json())
                                .then(freshFeed => {
                                    console.log(freshFeed);
                                    this.selectedFeed = freshFeed;
                                    this.showModal = true;
                                    history.pushState({
                                        feedId: freshFeed.id
                                    }, '', `/p/${freshFeed.id}`);
                                })
                                .catch(err => {
                                    console.error('Failed to fetch updated feed:', err);
                                });
                        },

                        closeModal() {
                            this.showModal = false;
                            history.pushState(null, '', '/profile');
                        },

                        archiveFeed(feedId) {
                            fetch(`/feeds/${feedId}/archive`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    }
                                })
                                .then(res => res.json())
                                .then(data => {
                                    const feed = this.feeds.find(f => f.id === feedId);
                                    if (feed) feed.archived = true;
                                    this.showModal = false;

                                    history.pushState({}, '', '/profile');

                                    this.showNotification(data.message);

                                })
                                .catch(error => {
                                    console.error('Error archiving feed:', error);
                                });
                        },

                        unarchiveFeed(feedId) {
                            fetch(`/feeds/${feedId}/unarchive`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    }
                                })
                                .then(res => res.json())
                                .then(data => {
                                    const feed = this.feeds.find(f => f.id === feedId);
                                    if (feed) feed.archived = false;

                                    this.selectedFeed.archived = false;
                                    this.showModal = false;
                                    history.pushState({}, '', '/profile');
                                    this.showNotification(data.message);
                                })
                                .catch(error => {
                                    console.error('Error unarchiving feed:', error);
                                });
                        },

                        deleteFeed() {
                            if (!this.selectedFeed?.id) {
                                alert('No feed selected');
                                return;
                            }

                            if (!confirm('Are you sure you want to delete this feed?')) return;

                            fetch(`/feeds/${this.selectedFeed.id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    },
                                    body: new URLSearchParams({
                                        '_method': 'DELETE',
                                    })
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Delete failed');
                                    this.selectedFeed = null;
                                    this.showModal = false;
                                    window.location.assign('/profile');
                                })
                                .catch(error => {
                                    console.error(error);
                                    alert('Failed to delete feed');
                                });
                        },

                        postComment() {
                            if (!this.comment.trim()) return;

                            fetch('/comments', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        comment: this.comment,
                                        feed_id: this.selectedFeed.id
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        this.selectedFeed.comments.push(data.comment);

                                        this.comment = '';
                                    } else {
                                        console.error('Comment not saved:', data.message || data);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error posting comment:', error);
                                });
                        },

                        deleteComment(commentId) {
                            fetch(`/comments/${commentId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    }
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        this.selectedFeed.comments = this.selectedFeed.comments.filter(c => c.id !== commentId);
                                    } else {
                                        console.error('Failed to delete comment:', data.message);
                                    }
                                })
                                .catch(err => console.error('Error deleting comment:', err));
                        },

                        async toggleLike(feedId) {
                            fetch(`/feeds/${feedId}/like`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    this.selectedFeed.liked_by_auth = data.liked;
                                    this.selectedFeed.likes_count = data.likes_count;
                                })
                                .catch(error => {
                                    console.error('Like toggle failed', error);
                                });
                        },

                        init() {
                            const pathParts = window.location.pathname.split('/');
                            const feedId = pathParts[pathParts.length - 1];
                            if (feedId && !isNaN(feedId)) {
                                this.openModal(feedId);
                            }

                            window.addEventListener('popstate', () => {
                                const isFeedRoute = location.pathname.startsWith('/p/');
                                this.showModal = isFeedRoute;
                            });

                            window.addEventListener('popstate', (event) => {
                                if (event.state && event.state.feedId) {
                                    this.openModal(event.state.feedId);
                                } else {
                                    this.closeModal();
                                }
                            });
                        }
                    };
                }
            </script>

        </div>
</x-app-layout>