
<template>
    <section class="py-5">
      <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-9">
                    <div class="card border-0 shadow-sm">
                        <div class="row g-0">
                            <!-- Lado esquerdo (somente imagem) -->
                            <div class="col-md-5 d-none d-md-block border-end">
                                <div class="p-4 h-100 d-flex flex-column justify-content-center align-items-center">
                                    <img src="/assets/img/illustrations/dental-auth-ai.png"
                                        alt="Clínica Inteligente com IA" class="img-fluid" style="max-width: 90%;" />
                                </div>
                            </div>


                            <!-- Lado direito (form de login) -->
                            <div class="col-md-7">
                                <div class="p-4 p-md-5">
                                    <!-- AQUI entra o conteúdo específico de cada tela -->
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</template>