const loginRequest = {
    scopes: ["User.ReadWrite"]
}

const myMsal = new Msal.UserAgentApplication(config);


function SignIn() {
    myMsal.loginPopup(loginRequest)
    .then(function (loginResponse) {
        //login success
        let idToken = loginResponse.idToken;
    }).catch(function (error) {
        //login failure
        console.log(error);
    });
}
function LogOut() {
    myMsal.logout();
}