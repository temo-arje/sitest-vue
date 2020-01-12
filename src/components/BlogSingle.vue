<template>
    <div>
        <header class="masthead" style="background-image: url('https://blackrockdigital.github.io/startbootstrap-clean-blog/img/post-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto" v-for="post in postfull">
                        <div class="post-heading">
                            <h1>{{post.title.rendered}}</h1>
                            <span class="meta">
              on {{post.date_gmt}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto" v-for="post in postfull">
                        <p>
                            {{post.title.rendered}}
                        </p>
                    </div>
                </div>
            </div>
        </article>
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
    export default {
        data() {
            return {
                postfull: [],
                isLoading: true
            }
        },
        created() {
            let app = this;
            let slug = app.$route.params.slug;
            fetch('/wp-json/wp/v2/posts?slug=' + slug).then(resp => resp.json()).then(resp => {
                this.isLoading = false;
                this.postfull = resp;
            });
        }
    }
</script>