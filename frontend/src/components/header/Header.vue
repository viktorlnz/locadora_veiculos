<template>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-primary" data-bs-theme="dark">
            <h1 class="navbar-brand mx-2"><router-link class="link-underline link-underline-opacity-0" to="/">Locadora Speedexis</router-link></h1>
            <button
                class="navbar-toggler mx-2"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/rentals">Reservas</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Perfil</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Sobre Nós</router-link>
                    </li>
                    <li class="nav-item p-1 text-center" id="li-login">
                        <router-link class="nav-link" to="/login">Login</router-link>
                    </li>
                  </ul>
            </div>
        </nav>
    </header>
</template>

<style lang="scss" scoped>
    *{
        color: white;
    }

    .nav-item{
        margin-left: 8px;
    }

    #li-login{
        background-color: var(--bs-secondary-color);
        border-radius: 8px;
        margin-right: 5px;
        width: 80px;
    
        .nav-link{
            color: white !important;
            font-weight: 400 !important;
        }
    }
</style>