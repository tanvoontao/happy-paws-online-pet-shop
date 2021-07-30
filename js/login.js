// identity platform initalize

var config = {
    apiKey: "AIzaSyAnqtdyKYyi_xfLSpvwuYnhd6UU0begUAk",
    authDomain: "carbon-stone-316903.firebaseapp.com",
};
firebase.initializeApp(config);



// create session via ajax
function createSessionAjax(id, email){
    $.ajax({
        type: 'post',
        url: 'code.php',
        data: {
            userId: id,
            userEmail: email
        },
        success: function (){
            //alert("ok")
            //console.log(document.getElementById("new_select"));
            //document.getElementById("new_select").innerHTML = response;
            window.location.replace("manage_categories.php");
        }
    }

    );
}


// submit form action
$("#loginForm").submit(function(event){
event.preventDefault(); // disable submit button function 

let email = $("#email").val();
let password = $("#password").val();
document.getElementById("sign_In_loading_spinner").style.display = "block";
// auto check identity
firebase.auth().signInWithEmailAndPassword(email, password)
    .then((authCredential)=>{
        
        //console.log(`user id: ${authCredential.user.uid}`)
        //alert("logined")
        createSessionAjax(authCredential.user.uid, authCredential.user.email)
        
        //listenForAuthChanges()


    })
    .catch((error)=>{
        //let errorCode = error.code;
        let errorMessage = error.message;
        //console.log(errorCode);
        //console.log(errorMessage);
        $("#error_txt").text(errorMessage);
        document.getElementById("sign_In_loading_spinner").style.display = "none";
    });
});