
// to initialize my web app
var config = {
    apiKey: "AIzaSyAnqtdyKYyi_xfLSpvwuYnhd6UU0begUAk",
    authDomain: "carbon-stone-316903.firebaseapp.com",
};
firebase.initializeApp(config);

function listenForAuthChanges(){
    firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        var uid = user.uid;
        var email = user.email;
        
        //console.log(`user ${email} is isgned in`);
        //alert(`user ${email} is isgned in`);
        //window.location.replace("test.php");
    } else {
        //console.log(`signed out`);
        //alert(`signed out`);
        window.location.replace("login.php");
    }
    });
}



function myFunction(){
    firebase.auth().signOut();
    listenForAuthChanges()
}






window.onload = listenForAuthChanges();