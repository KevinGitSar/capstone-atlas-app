<template>
    <div class="container gallery">
        <div class="placeholder-box">1</div>
        <div class="placeholder-box">2</div>
        <div class="placeholder-box">3</div>
        <div class="placeholder-box">4</div>
        <div class="placeholder-box">5</div>
        <div class="placeholder-box">6</div>
        <div class="placeholder-box">1</div>
        <div class="placeholder-box">2</div>
        <div class="placeholder-box">3</div>
        <div class="placeholder-box">4</div>
        <div class="placeholder-box">5</div>
        <div class="placeholder-box">6</div>
    </div>
</template>

<style scoped>
    .gallery{
        background-color: #DDE1DA;
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    .placeholder-box{
        flex: 0 0 15%;
        width: 100px;
        height: 150px;
        background-color: black;
        margin: 2.5%;
    }
</style>