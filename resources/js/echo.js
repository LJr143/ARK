import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// window.Pusher = Pusher;

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

if (!csrfToken) {
    console.warn('CSRF token not found - WebSocket authentication may fail');
}

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
    enabledTransports: ['ws', 'wss'],
    disableStats: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    },
});

// Debugging
window.Echo.connector.pusher.connection.bind('state_change', (states) => {
    console.log('Connection state:', states.current);
});

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('WebSocket error:', error);
});

