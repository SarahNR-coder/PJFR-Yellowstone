/* // Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDxEuDa0ewmFsBOeV0rAgPHqmWJ7eKg51U",
  authDomain: "pjfr-yellowstone.firebaseapp.com",
  databaseURL: "https://pjfr-yellowstone-default-rtdb.firebaseio.com",
  projectId: "pjfr-yellowstone",
  storageBucket: "pjfr-yellowstone.appspot.com",
  messagingSenderId: "866729405582",
  appId: "1:866729405582:web:9d6a2c018178740563addf",
  measurementId: "G-SJDPVKB7C3"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
//Définition des tables et données
const dbRef = firebase.database().ref();
const usersRef = dbRef.child("users"); */