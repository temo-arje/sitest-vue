<template>
    <div>
        <header class="masthead" style="background-image: url('https://blackrockdigital.github.io/startbootstrap-clean-blog/img/home-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            <h1>ბლოგი</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-preview" v-for="post in posts">
                        <router-link :to="{ name: 'BlogSingle', params: {slug: post.slug } }">
                            <h2 class="post-title">
                              {{post.title.rendered}}
                            </h2>
                        </router-link>
                        <p class="post-meta" v-html="post.content.rendered">
                        </p>
                        <hr>
                    </div>

                    <!-- Pager -->
                </div>
            </div>
        </div>
        <infinite-loading spinner="waveDots" @distance="1" @infinite="infiniteHandler">
        	<span slot="no-more">
                <h4 class="no-data" v-bind:style="{fontFace: 'BPG Banner sans-serif'}">დამატებითი ინფორმაცია ვერ მოიძებნა</h4>
        	</span>
        </infinite-loading>
        <div class="loader" v-if="isLoading">
            <div class="loader-inner">
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data() {
            return {
                posts: [],
                isLoading: true,
                currentPage: 0,
            }
        },
        components: {
            InfiniteLoading,
        },
        created() {
            // this.page++;
            // this.axios.get('https://wordpress.dev/wp-json/wp/v2/posts?_embed&per_page=24&page='+self.currentPage).then(resp =>{
            //     this.posts = resp.data;
            //     this.isLoading = false;
            // })
        },
        methods: {
            infiniteHandler($state) {
                this.currentPage++;
                // let app = this;
                this.axios.get('/wp-json/wp/v2/posts?_embed&per_page=5&page=' + this.currentPage).then(resp => {
                    let posts = resp.data;
                    this.isLoading = false;
                    this.posts = this.posts.concat(posts);
                    setTimeout(function () {
                        $state.loaded();
                    }, 1000);
                }).catch(e => {
                    $state.complete()
                })
            }
        }
    }
</script>