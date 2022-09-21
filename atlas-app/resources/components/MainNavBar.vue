<template>
    <nav class="navbar navbar-expand-sm mt-4 mb-5 p-0 topnav">
        <div class="ml-4">
            <input class="mr-1" type="text" placeholder="Search..." />
            <button type="submit">Search</button>
        </div>
        <div>
            <a href="#" class="navbar-brand m-0">Home</a>
            <a href="#" class="navbar-brand m-0">Contact Us</a>
            <a href="#" class="navbar-brand m-0">About</a>
        </div>
        <div class="login">
            <a href="/login" class="navbar-brand m-0">Login</a>
        </div>
    </nav>
</template>

<!-- <script>
    export default {
        name: MainNavBar
    }
</script> -->
    

<style scoped>
    .login{
        margin-right: 5%;
    }

    a {
        color: white;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
        padding: 10px;
    }

    nav {
        overflow: hidden;
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