<template>
    <section>
        <header>
            <nav>
                <a class="tab toggle" :class="{ 'active': is_dated }" @click.prevent="toggleType">Op datum</a>
                <a class="tab toggle" :class="{ 'active': is_weekly }" @click.prevent="toggleType">Wekelijks</a>
            </nav>
        </header>
    
        <transition name="fade">
            <div v-show="is_weekly">
                <slot name="agenda"></slot>
            </div>
        </transition>
        <transition name="fade">
            <div v-show="is_dated" class="dates">
                <section v-for="(_posts, index) in getPostsOnDate()" :key="index" class="posts">
                    <h2 class="date-title">
                        {{ formattedDate(index) }}
                    </h2>
                    <article class="post" v-for="post in _posts" :key="post.id">
                        <aside class="post_time">
                            <span class="post-time">{{ formattedTime(post.StartTime) }}-{{ formattedTime(post.FinishTime) }}</span>
                        </aside>
                        <main class="post_main">
                            <h3 class="post-title"><a :href="getPermalink(post.slug)">{{ post.post_title }}</a></h3>
                            <h6 class="post-subtitle">{{ post.custom.catchphrase }}</h6>
                        </main>
                        <aside class="post_info">
                            <span class="extra-info">{{ post.custom.extra_info }}</span>
                        </aside>
                    </article>
                </section>
            </div>
        </transition>
    </section>
</template>

<script>
    import { format } from 'date-fns';
    import { nl } from 'date-fns/locale';
    import { groupBy } from 'lodash';
    
    
    export default {
        name: "AgendaList",
        props: {
            posts: {
                type: Array,
                default: () => ([])
            }
        },
        data() {
            return {
                is_dated: false,
                is_weekly: true
            }
        },
        methods: {
            toggleType() {
                this.is_weekly = !this.is_weekly;
                this.is_dated  = ! this.is_dated;
            },
            formattedDate(date) {
                return format(new Date(date), 'EEEEEE d MMMM yyyy', { locale: nl });
            },
            getPostsOnDate() {
                return groupBy(this.posts, 'StartDate');
            },
            formattedTime(time) {
                let timeArr = time.split(':');
                timeArr.pop();
                return timeArr.join(':')
            },
            getPermalink(slug) {
                return `/events/event/${slug}`;
            }
        }
    }
</script>

<style scoped lang="sass">
.tab
    display: inline-block
    background: transparent
    color: #27509b !important
    padding: 0.5rem
    cursor: pointer
    transition: all 225ms cubic-bezier(0.2, 0.4, 0.2, 1.0)
    &.active
        background: #a1cfc4
        
    &:hover
        background: transparentize(#a1cfc4, 0.4)
        
.posts
    border-top: 2px solid white
    margin: 0.75rem 0
    padding: 0.75rem 0
    &:last-of-type
        border-bottom: 2px solid white
    .post
        color: white
        display: grid
        grid-template-columns: 1fr 2fr 2fr
        grid-column-gap: 2rem
        .post_main
            .post-title
                font-size: 1rem
                font-weight: bold
                margin-bottom: 0
                a
                    color: white
        .post_info
            text-align: right
        
.date-title
    color: #27509b
    font-weight: bold
    font-size: 3rem
    font-style: italic
</style>
