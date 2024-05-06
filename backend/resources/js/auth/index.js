class Auth{
    user = [];
    token = '';

    constructor(){
        this.userData = window.sessionStorage.getItem('user');
        this.token = window.sessionStorage.getItem('token');
        this.user = this.userData ? JSON.parse(this.userData) : null;
    }

    login(token,user){
        window.sessionStorage.setItem('token',token);
        window.sessionStorage.setItem('user',JSON.stringify(user));

        this.token = token;
        this.user = user;
    }

    check(){
        return !! this.token;
    }

    logout(){
        window.sessionStorage.removeItem('token');
        window.sessionStorage.removeItem('user');
        this.token = '';
        this.user = null;
    }
}

export default new Auth();
