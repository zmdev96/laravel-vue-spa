import Login from '../pages/auth/Login.vue';
import Register from '../pages/auth/Register.vue';
import PasswordEmail from '../pages/auth/PasswordEmail.vue';
import PasswordReset from '../pages/auth/PasswordReset.vue';
import Home from '../pages/Home.vue';
import Posts from '../pages/posts/Posts.vue';
import PostsShow from '../pages/posts/PostsShow.vue';
import About from '../pages/About.vue';
import Contact from '../pages/Contact.vue';


import CategoriesIndex from '../pages/categories/Index.vue';
import CategoriesSingel from '../pages/categories/Singel.vue';
import CategoriesSub from '../pages/categories/Sub.vue';

import AdsCategoriesIndex from '../pages/ads_categories/Index.vue';
import AdsCategoriesSingel from '../pages/ads_categories/Singel.vue';

import AdsIndex from '../pages/ads/Ads.vue';
import AdsShow from '../pages/ads/AdsShow.vue';


import SettingsIndex from '../pages/settings/Index.vue';
import SettingsAccount from '../pages/settings/Account.vue';
import SettingsGeneral from '../pages/settings/General.vue';
import SettingsSecurity from '../pages/settings/Security.vue';


import ProfileMain from '../pages/profile/ProfileMain.vue';
import ProfilePostsIndex from '../pages/profile/posts/PostsIndex.vue';
import ProfilePostsCreate from '../pages/profile/posts/PostsCreate.vue';
import ProfilePostsEdit from '../pages/profile/posts/PostsEdit.vue';
import ProfilePostsShow from '../pages/profile/posts/PostsShow.vue';

import ProfileAdsIndex from '../pages/profile/ads/AdsIndex.vue';
import ProfileAdsCreate from '../pages/profile/ads/AdsCreate.vue';
import ProfileAdsEdit from '../pages/profile/ads/AdsEdit.vue';
import ProfileAdsShow from '../pages/profile/ads/AdsShow.vue';


import NotFound from '../pages/404.vue';

export const routes = [
  // Auth Routes
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
     notAuth: true
    }
  },
  {
    path: '/password/email',
    name: 'password.email',
    component: PasswordEmail,
    meta: {
     notAuth: true
    }
  },
  {
    path: '/password/reset/:token',
    name: 'password.reset',
    component: PasswordReset,
    meta: {
     notAuth: true
    }
  },
  // Web Routes
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/posts',
    name: 'posts',
    component: Posts,
  },
  {
    path: '/posts/:id',
    name: 'posts.show',
    component: PostsShow,
  },
  {
    path: '/categories',
    name: 'categories',
    component: CategoriesIndex,
  },
  {
    path: '/categories/:id',
    name: 'categories.singel',
    component: CategoriesSingel,
  },
  {
    path: '/categories/sub/:id',
    name: 'categories.sub',
    component: CategoriesSub,
  },
  {
    path: '/ads_categories',
    name: 'ads_categories',
    component: AdsCategoriesIndex,
  },
  {
    path: '/ads_categories/:id',
    name: 'ads_categories.singel',
    component: AdsCategoriesSingel,
  },
  {
    path: '/ads',
    name: 'ads.index',
    component: AdsIndex,
  },
  {
    path: '/ads/:id',
    name: 'ads.show',
    component: AdsShow,
  },

  // Member Settings routes
  {
    path: '/settings',
    component: SettingsIndex,
    name: 'settings.index',
    meta:{
      auth: true,
    },
    children: [
      { path: '', redirect: { name: 'settings.account' } },
      { path: 'account', name: 'settings.account', component: SettingsAccount },
      { path: 'general', name: 'settings.general', component: SettingsGeneral },
      { path: 'security', name: 'settings.security', component: SettingsSecurity },
    ]
  },
  // Member Profile routes
  {
    path: '/profile',
    component: ProfileMain,
    name: 'profile.main',
    meta:{
      auth: true,
    },
    children: [
      { path: '', redirect: { name: 'profile.posts.index' } },
      { path: 'posts/index', name: 'profile.posts.index', component: ProfilePostsIndex },
      { path: 'posts/create', name: 'profile.posts.create', component: ProfilePostsCreate },
      { path: 'posts/:id', name: 'profile.posts.show', component: ProfilePostsShow },
      { path: 'posts/edit/:id', name: 'profile.posts.edit', component: ProfilePostsEdit },
      { path: 'ads/index', name: 'profile.ads.index', component: ProfileAdsIndex },
      { path: 'ads/create', name: 'profile.ads.create', component: ProfileAdsCreate },
      { path: 'ads/:id', name: 'profile.ads.show', component: ProfileAdsShow },
      { path: 'ads/edit/:id', name: 'profile.ads.edit', component: ProfileAdsEdit },


    ]
  },
  {
   path: '/about',
   name: 'about',
   component: About,
  },
  {
   path: '/Contact',
   name: 'Contact',
   component: Contact,
  },
  {
    path: '*',
    name: '404',
    component: NotFound
  }


];
