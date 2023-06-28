import ErrorForbidden from '@/views/errors/Forbidden.vue';
import ErrorNotFound from '@/views/errors/NotFound.vue';
import PostNonpublished from '@/views/post/Nonpublished.vue';
import PostPublished from '@/views/post/Published.vue';
import PostTrashed from '@/views/post/Trashed.vue';

const routes = [

  // Dashboard
  {
    name: 'dashboard',
    path: '/administration',
    component: PostNonpublished,
  },

  // Posts
  {
    name: 'posts-nonpublished',
    path: '/administration/posts/nonpublished',
    component: PostNonpublished,
  },

  {
    name: 'posts-published',
    path: '/administration/posts/published',
    component: PostPublished,
  },

  {
    name: 'posts-trashed',
    path: '/administration/posts/trashed',
    component: PostTrashed,
  },

  // Authorization
  {
    name: 'forbidden',
    path: '/forbidden',
    component: ErrorForbidden,
  },
  {
    name: 'not-found',
    path: '/not-found',
    component: ErrorNotFound,
  }
];

export default routes