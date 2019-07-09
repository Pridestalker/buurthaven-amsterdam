<template>
    <article class="post" >
        <aside class="post_time">
            <span v-if="showDate" class="post-date">{{ formattedDate(post.StartDate) }}</span>
            <span class="post-time">{{ formattedTime(post.StartTime) }}-{{ formattedTime(post.FinishTime) }}</span>
            <small v-if="post.StartDate !== post.EndDate" class="post-end-date" :class="`post-end-date_${post.ID}`">tot {{ formattedDate(post.EndDate) }}</small>
        </aside>
        <main class="post_main">
            <h3 class="post-title"><a :href="getPermalink(post.slug)">{{ post.post_title }}</a></h3>
            <h6 class="post-subtitle">{{ post.custom.catchphrase }}</h6>
        </main>
        <aside class="post_info d-none d-md-flex">
            <span class="extra-info">{{ post.custom.extra_info }}</span>
        </aside>
    </article>
</template>

<script>
    import { format } from 'date-fns';
    import { nl } from 'date-fns/locale';
    
    export default {
        name: "PostComponent",
        props: {
            post: {
                type: Object,
            },
            showDate: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            formattedTime(time) {
                let timeArr = time.split(':');
                timeArr.pop();
                return timeArr.join(':')
            },
            getPermalink(slug) {
                return `/events/event/${slug}`;
            },
            formattedDate(date) {
                return format(new Date(date), 'EEEEEE d MMMM yyyy', { locale: nl });
            },
        }
    }
</script>

<style scoped lang="sass">

.post
    color: white
    display: grid
    grid-template-columns: 1fr 2fr 2fr
    grid-column-gap: 2rem
    margin-bottom: 0.425rem
    
    @media screen and (max-width: 414px)
        grid-template-columns: 1fr 1fr
    
    .post_main
        .post-title
            font-size: 1rem
            font-weight: bold
            margin-bottom: 0
            a
                color: white
    .post-date
        display: block
        
    .post_info
        justify-content: end
        
    .post-end-date
        display: block
    
    &:not(:last-of-type)
        border-bottom: 1px solid rgba(255, 255, 255, 0.28)
</style>
