<template>
    <div class="container">
        <h2 class="text-center display-4">Login</h2>
        <form>
            <div class="form-row form-center">
                <div class="form-group col-md-6">
                    <label>Username: </label>
                    <input type="text" class="form-control" placeholder="Username" required />
                    <br />
                    <label>Password: </label>
                    <input type="password" class="form-control" placeholder="Password" min="8" required />
                    <br />
                    <button type="submit" class="btn btn-outline-success btn-lg">Log in</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg btn-right">Sign up</button>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>
    .form-center{
        display: flex;
        justify-content: center;
    }

    .btn-right{
        float: right;
    }
</style>