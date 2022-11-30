<template>
    <nav class="navbar navbar-expand-sm mt-4 mb-5 p-0 topnav">
        <div class="ml-4">
            <h2 class="admin-view">Adminstrative View</h2>
        </div>
        <div class="dropdown login">
            <a href="#" class="navbar-brand m-0" role="button" data-toggle="dropdown" aria-expanded="false">{{user.username}}</a>
            <ul class="dropdown-menu">
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