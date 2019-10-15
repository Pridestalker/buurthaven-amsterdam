<!--suppress HtmlUnknownAttribute -->
<template>
  <section>
    <header>
      <nav>
        <a class="tab toggle" :class="{ 'active': is_dated }" @click.prevent="toggleType">Op datum</a>
        <a class="tab toggle" :class="{ 'active': is_weekly }" @click.prevent="toggleType">Wekelijks</a>
      </nav>
    </header>
    <transition name="fade" mode="out-in">
      <div v-if="is_weekly" key="weekly">
        <section v-for="(__posts, index) in getPostsOnWeek()" :key="index" class="posts">
          <h2 class="date-title">week {{ index }}</h2>
          <post-component v-for="_post in __posts" :key="_post.id" :post="_post" show-date></post-component>
        </section>
      </div>
      <div v-if="is_dated" class="dates" key="dated">
        <section v-for="(_posts, index) in getPostsOnDate()" :key="index" class="posts">
          <h2 class="date-title">{{ formattedDate(index) }}</h2>
          <post-component v-for="post in _posts" :key="post.id" :post="post"></post-component>
        </section>
      </div>
    </transition>
    <div v-if="posts.length === 0" :key="'empty'">
      <h2 class="date-title">Er staan nog geen activiteiten in de agenda.</h2>
    </div>
  </section>
</template>

<script>
import { format, getISOWeek } from "date-fns";
import { nl } from "date-fns/locale";
import { groupBy, union } from "lodash";
import PostComponent from "./agenda/PostComponent";

export default {
  name: "AgendaList",
  components: { PostComponent },
  props: {
    posts: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      is_dated: true,
      is_weekly: false
    };
  },
  methods: {
    toggleType() {
      this.is_weekly = !this.is_weekly;
      this.is_dated = !this.is_dated;
    },
    formattedDate(date) {
      return format(new Date(date), "EEEEEE d MMMM yyyy", { locale: nl });
    },
    formattedWeek(date) {
      return format(new Date(date), "W", { locale: nl });
    },
    getPostsOnDate() {
      return groupBy(this.posts, "StartDate");
    },
    getPostsOnWeek() {
      this.posts.map(p => {
        p.weekDay = getISOWeek(new Date(p.StartDate));
        return p;
      });
      return groupBy(this.posts, "weekDay");
    }
  }
};
</script>

<style scoped lang="sass">
$primary: #27509b
$secondary: #a1cfc4
.tab
    display: inline-block
    background: transparent
    color: $primary !important
    padding: 0.5rem
    cursor: pointer
    transition: all 225ms cubic-bezier(0.2, 0.4, 0.2, 1.0)
    &.active
        background: $secondary
        
    &:hover
        background: transparentize($secondary, 0.4)
        
.posts
    border-top: 2px solid white
    margin: 0.75rem 0
    padding: 0.75rem 0
    &:last-of-type
        border-bottom: 2px solid white
        
.date-title
    color: $primary
    font-weight: bold
    font-size: 3rem
    font-style: italic
    
    @media screen and (max-width: 414px)
        font-size: 2rem
    
.fade-enter-active, .fade-leave-active
    transition: all 300ms cubic-bezier(0.2, 0.4, 0.2, 1.0)
  
.fade-enter, .fade-leave-to
    opacity: 0

</style>
