import './assets/main.css'
import router from './router'
import { createApp } from 'vue'
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import App from './App.vue'
import { useToast } from 'vue-toastification';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { serverUrl } from "@/config.js";
const toast = useToast();
window.Pusher = Pusher;
const userId =localStorage.getItem('id');
if(userId){

    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: 'caa359463e78926e217b',
      cluster: 'eu',
      forceTLS: true,
      
      // 👇 Important: set this to your Laravel backend URL
      authEndpoint: `${serverUrl}/broadcasting/auth`,
      auth: {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}` // Only if using token auth
        }
      }
    });
    window.Echo.private(`leader-notification.${userId}`)
        .listen('.new-notification', (data) => {
            // console.log('New notification for leader:', data);
            toast.info(`New notification: ${data.notification.message}`);
        });
}

const app = createApp(App);

app.use(router);
app.use(Toast);

app.mount('#app');

