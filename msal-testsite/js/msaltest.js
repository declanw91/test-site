const myMsal = new Msal.UserAgentApplication(config);

const accessTokenRequest = {
    scopes: ["user.read"]
}

function RequestToken() {
    myMsal.acquireTokenSilent(accessTokenRequest).then(function(accessTokenResponse) {
        // Acquire token silent success
        // Call API with token
        let accessToken = accessTokenResponse.accessToken;
        CallMsGraph(accessToken);
    }).catch(function (error) {
        //Acquire token silent failure, and send an interactive request
        if (error.errorMessage.indexOf("interaction_required") !== -1) {
            myMsal.acquireTokenPopup(accessTokenRequest).then(function(accessTokenResponse) {
                // Acquire token interactive success
                console.log(accessTokenResponse);
                //CallMsGraph(accessToken);
            }).catch(function(error) {
                // Acquire token interactive failure
                console.log(error.errorMessage);
            });
        }
        console.log(error.errorMessage);
    });
}

function SignIn() {
    myMsal.loginPopup(accessTokenRequest)
    .then(function (loginResponse) {
        //login success
        let idToken = loginResponse.idToken;
        RequestToken();
    }).catch(function (error) {
        //login failure
        console.log(error);
    });
}
function LogOut() {
    jQuery('#signInBtn').show();
    myMsal.logout();
}
function CallMsGraph(token) {
    jQuery('#signInBtn').hide();
    var headers = new Headers();
    var bearer = "Bearer " + token;
    headers.append("Authorization", bearer);
    var options = {
         method: "GET",
         headers: headers
    };
    var graphEndpoint = "https://graph.microsoft.com/v1.0/me";

    fetch(graphEndpoint, options)
        .then(function (response) {
             //do something with response
             response.json().then(function(result) {
                 console.log(result);
                 LoadProfileDetails(result);
             });
        });
}

function Reset() {
    jQuery('#signInBtn').show();
    jQuery('#signOutBtn').show();
}

function LoadProfileDetails(details) {
    jQuery('#userDisplayName').text(details.displayName);
    jQuery('#userGivenName').text(details.givenName);
    jQuery('#userSurname').text(details.surname);
    jQuery('#userPrincipalName').text(details.userPrincipalName);
}
jQuery(document).ready(function() {
    Reset();
});