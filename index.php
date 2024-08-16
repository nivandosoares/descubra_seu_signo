<?php include('layouts/header.php'); ?>

<div class="container text-center mt-5">
    <h1 class="display-4" style="font-family: 'Montserrat', sans-serif; color: #333;">Descubra seu Signo</h1>
    <p class="lead" style="color: #555;">Informe sua data de nascimento para descobrir seu signo do zodíaco.</p>
    
    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="dia" class="form-label">Dia</label>
                    <input type="number" class="form-control" id="dia" name="dia" placeholder="Ex.: 21" min="1" max="31" required
                           style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="mes" class="form-label">Mês</label>
                    <input type="number" class="form-control" id="mes" name="mes" placeholder="Ex.: 05" min="1" max="12" required
                           style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg mt-3" 
                style="border-radius: 30px; background-color: #007bff; border: none; padding: 10px 20px;">
            Descobrir
        </button>
    </form>
</div>

</body>
</html>
