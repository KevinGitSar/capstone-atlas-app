<template>
    <nav class="navbar navbar-expand-sm mt-4 mb-5 p-0 topnav">
        <div class="ml-4">
            <form action="/profile/search" method="GET">
                <input class="mr-1" name="profile" type="text" placeholder="Search a profile..." />
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="dropdown login">
            <a href="#" class="navbar-brand m-0" role="button" data-toggle="dropdown" aria-expanded="false">Welcome {{user.username}}</a>
            <ul class="dropdown-menu">
                <li>
                    <a :href="'/profile/'+user.username" class="dropdown-item navbar-brand m-0">Posts</a>
                </li>
                <li>
                    <a href="#" class="dropdown-item navbar-brand m-0">Inbox</a>
                </li>
                <li>
                    <a href="/settings" class="dropdown-item navbar-brand m-0">Settings</a>
                </li>
                <li>
                    <form method="POST" action="/logout" class="dropdown-item navbar-brand m-0">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <button type="submit">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    props: ['user'],
    data(){
          return {
            //csrf token
             csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
       }
    }
}
</script>

<style scoped>
    .dropdown-menu{
        width: 100%;
        text-align: center;
        background: #354F52;
    }
    .login{
        margin-right: 2%;
    }

    a {
        color: white;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
        padding: 10px;
    }

    nav {
        background-color: #354F52;
        display: flex;
        justify-content: space-between;
    }

    nav a:hover {
        background-color: #52796F;
        color: white;
    }

    /* Change the color of links on hover */
    /* nav a:hover {
    background-color: #ddd;
    color: black;
    } */

    /* Style the "active" element to highlight the current page */
    /* nav a.active {
    background-color: #2196F3;
    color: white;
    } */

    /* Style the search box inside the navigation bar */
    /* nav input[type=text] {
    float: left;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
    } */

    /* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
    @media screen and (max-width: 600px) {
    nav a, nav input[type=text] {
        float: none;
        display: block;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 14px;
    }
    nav input[type=text] {
        border: 1px solid #ccc;
    }

}
</style>