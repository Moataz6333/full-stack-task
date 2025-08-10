import Login from "@/views/Login.vue";
import { createRouter, createWebHistory } from "vue-router";
import Home from "@/views/Home.vue";
import NotFoundView from "@/views/NotFoundView.vue";
import unauthorized from "@/views/unauthorized.vue";
import AdminDashboard from "@/views/Admin/Dashboard.vue";
import UserDashboard from "@/views/User/Dashboard.vue";
import UserLogin from "@/views/UserLogin.vue";
import CreatePost from "@/views/CreatePost.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/admin/login",
      name: "login",
      component: Login,
    },
    {
      path: "/user/login",
      name: "user-login",
      component: UserLogin,
    },

   {
    path:"/admin/dashboard",
    name:"admin-dashboard",
    component: AdminDashboard,
    meta: { requiresAuth: true },
   },
   {
    path:"/user/dashboard",
    name:"user-dashboard",
    component: UserDashboard,
    meta: { requiresAuth: true },
   },{
    path:"/create-post",
    name:"create-post",
    component: CreatePost,
    meta: { requiresAuth: true },
   },

    {
      path: "/unauthorized",
      name: "unauthorized",
      component: unauthorized,
    },
    {
      path: "/:catchAll(.*)",
      name: "notFound",
      component: NotFoundView,
    },
  ],
});

router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem("token");
  if (to.meta.requiresAuth && !isLoggedIn) {
    next("/unauthorized");
  } else {
    next();
  }
});

export default router;
