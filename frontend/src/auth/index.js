class Auth {
    user = [];
    userInfo = [];
    token = '';
    sessionTimeout = 60 * 60 * 1000; // Timeout duration in milliseconds (60 minutes)
  
    constructor() {
      this.userData = window.sessionStorage.getItem('user');
      this.userInfoData = window.sessionStorage.getItem('userInfo');
      this.token = window.sessionStorage.getItem('token');
      this.user = this.userData ? JSON.parse(this.userData) : null;
      this.userInfo = this.userData ? JSON.parse(this.userInfoData) : null;
  
      // Check if session has expired
      const sessionTimeout = parseInt(window.sessionStorage.getItem('sessionTimeout'));
      if (Date.now() > sessionTimeout) {
        this.logout();
      }
    }
  
    login(token, user, userInfo) {
      const sessionTimeout = Date.now() + this.sessionTimeout;
      window.sessionStorage.setItem('token', token);
      window.sessionStorage.setItem('user', JSON.stringify(user));
      window.sessionStorage.setItem('userInfo', JSON.stringify(userInfo));
      window.sessionStorage.setItem('sessionTimeout', sessionTimeout.toString());
      this.token = token;
      this.user = user;
      this.userInfo = userInfo;
    }
  
    check() {
      // Check if session has expired
      const sessionTimeout = parseInt(window.sessionStorage.getItem('sessionTimeout'));
      if (sessionTimeout && Date.now() > sessionTimeout) {
        this.logout();
        return false;
      }
  
      return !!this.token;
    }
  
    logout() {
      window.sessionStorage.removeItem('user');
      window.sessionStorage.removeItem('token');
      window.sessionStorage.removeItem('userInfo');
      window.sessionStorage.removeItem('sessionTimeout');
      this.token = '';
      this.user = null;
      this.userInfo = null;
    }
  }
  
  export default new Auth();
  