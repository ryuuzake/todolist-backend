<html>
    <head>
        <meta charset="UTF-8" />
        <title>FirebaseUI Auth Demo</title>
        <link
            type="text/css"
            rel="stylesheet"
            href="https://www.gstatic.com/firebasejs/ui/6.0.0/firebase-ui-auth.css"
        />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body>
        <form id="registration-form">
            <input id="name" type="text">
            <input id="email" type="email">
            <input id="password" type="password">
            <input id="confirm-password" type="password">
            <input type="submit" value="submit">
        </form>
    </body>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js";
        import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.5.0/firebase-auth.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/9.5.0/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCUwGm2CQ0EqwSTKmsNSsWEc_CRJNSSgwA",
            authDomain: "todolist-backend-2a888.firebaseapp.com",
            projectId: "todolist-backend-2a888",
            storageBucket: "todolist-backend-2a888.appspot.com",
            messagingSenderId: "388791324805",
            appId: "1:388791324805:web:1e967fb0eec9c4f7b819ec",
            measurementId: "G-NVR2PB9NN8",
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth();
        const messaging = getMessaging();

        const form = document.getElementById("registration-form");
        form.onsubmit = function() {
            event.preventDefault();
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const password_confirmation = document.getElementById("confirm-password").value;

            createUserWithEmailAndPassword(auth, email, password)
                .then((userCred) => {
                    const user = userCred.user;

                    getToken(messaging, { vapidKey: 'BEQ2EmUxtl-pjUoe0kQJzJi2qBB2eXzNCdp4dqCmLujSvQlnnGkXco-bR8EwCluMIXH-L_keMj8CsF6w1E61fu0' })
                        .then((currentToken) => {
                            if (currentToken) {
                                fetch(window.location.href, {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({
                                        name,
                                        email,
                                        password,
                                        password_confirmation,
                                        fcm_token: currentToken,
                                        firebase_uid: user.uid,
                                    }),
                                })
                            }
                        })
                        .catch((err) => {
                            console.log('An error occurred while retrieving token. ', err);
                        });
                })
                .catch((error) => {
                    const errorCode = error.code;
                    const errorMsg = error.message;
                });
        }
    </script>
</html>
