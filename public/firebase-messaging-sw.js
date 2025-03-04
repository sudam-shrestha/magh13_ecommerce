// firebase-messaging-sw.js
// Use importScripts instead of import
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');

// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCDoxz4_eCpnRexb6QddGZdI4bLfTJZPN0",
    authDomain: "magh13.firebaseapp.com",
    projectId: "magh13",
    storageBucket: "magh13.firebasestorage.app",
    messagingSenderId: "122828337174",
    appId: "1:122828337174:web:3b9cd6fa243325852d4537",
    measurementId: "G-5HLPJTHC2J"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon || '/firebase-logo.png' // Optional: add an icon
    };

    // Show the notification
    self.registration.showNotification(notificationTitle, notificationOptions);
});
