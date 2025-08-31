<?php
session_start();
$logged = $_SESSION['logged'] ?? false;
$nombreUser = $_SESSION['nombre'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mil y un Cabellos</title>
  <style>
    :root { --blue:#004179; --blue-light:#0058a3; --white:#fff; --shadow:0 4px 12px rgba(0,0,0,.06); --radius:8px; --transition:all .3s ease; }
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:'Helvetica Neue', Arial, sans-serif;color:#333;background:var(--white);line-height:1.5;overflow-x:hidden;}
    header{background:url('https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg') center/cover no-repeat;color:var(--white); text-align:center; padding:100px 20px; position:relative; isolation:isolate;}
    header::after{ content:''; position:absolute; inset:0; background:rgba(0,65,121,.55); pointer-events:none; z-index:0; }
    header h1, header p, header .btn-login{position:relative; z-index:1;}
    header h1{font-size:3rem;margin-bottom:10px;}
    header p{font-size:1.2rem;}
    .btn-login{margin-top:16px;background:linear-gradient(135deg,#8b7eff,#c9c9c9,#5a4eff);color:#fff;padding:14px 28px;border:none;border-radius:30px;font-size:1rem;cursor:pointer;font-weight:bold;box-shadow:0 10px 24px rgba(0,0,0,.25);transition: transform .25s ease, box-shadow .25s ease;}
    .btn-login:hover{transform:translateY(-2px) scale(1.04);box-shadow:0 14px 30px rgba(0,0,0,.28);}
    nav{background:var(--white);border-bottom:1px solid #eee;position:sticky;top:0;z-index:1000;}
    nav ul{display:flex;justify-content:center;align-items:center;list-style:none;padding:14px 10px;gap:22px;}
    nav a{text-decoration:none;color:#333;font-weight:500;position:relative;padding:6px 8px;transition:color .2s ease;}
    nav a::after{content:'';position:absolute;left:0;bottom:-4px;height:2px;width:0%;background:var(--blue-light);transition:width .25s ease;}
    nav a:hover{color:var(--blue-light);}
    nav a:hover::after{width:100%;}
    section{padding:60px 20px;max-width:1000px;margin:auto;}
    h2{font-size:2rem;text-align:center;margin-bottom:40px;color:var(--blue);}
    .carousel{position:relative;overflow:hidden;border-radius:var(--radius);box-shadow:var(--shadow);height:350px;margin-bottom:40px;}
    .slides{display:flex;height:100%;transition:transform .6s ease-in-out;}
    .slide{flex:1 0 100%;display:flex;justify-content:center;align-items:center;font-size:2rem;color:var(--white);text-align:center;padding:0 20px;position:relative;background-size:cover;background-position:center;}
    .slide::after{content:'';position:absolute;inset:0;background:rgba(0,65,121,.45);}
    .slide span{position:relative;z-index:1;text-shadow:0 2px 6px rgba(0,0,0,.4);}
    .carousel-buttons{position:absolute;top:50%;width:100%;display:flex;justify-content:space-between;padding:0 15px;transform:translateY(-50%);pointer-events:none;}
    .carousel-buttons button{pointer-events:auto;background:rgba(255,255,255,.75);border:none;font-size:1.5rem;color:var(--blue);width:40px;height:40px;border-radius:50%;cursor:pointer;transition:var(--transition);backdrop-filter:blur(4px);}
    .carousel-buttons button:hover{background:rgba(255,255,255,.95);transform:translateY(-2px);}
    .btn{background:var(--blue);color:var(--white);padding:12px 24px;border:none;border-radius:var(--radius);font-size:1rem;cursor:pointer;transition:var(--transition);}
    .btn:hover{background:var(--blue-light);transform:translateY(-2px);}
    .modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);justify-content:center;align-items:center;z-index:2000;animation:fadeIn .25s ease both;}
    .modal-content{background:var(--white);padding:30px;border-radius:var(--radius);width:90%;max-width:420px;box-shadow:var(--shadow);text-align:center;transform:translateY(12px);animation:slideUp .35s ease both;}
    .modal-content input, .modal-content select{width:100%;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:var(--radius);transition:border-color .2s;}
    .modal-content input:focus, .modal-content select:focus{outline:none;border-color:var(--blue-light);}
    .close{position:absolute;top:20px;right:30px;font-size:1.6rem;cursor:pointer;color:var(--white);user-select:none;}
    #form-cita{display:none;background:#f5f5f5;border-radius:var(--radius);padding:30px;box-shadow:var(--shadow);max-width:520px;margin:20px auto 0;animation:fadeInUp .5s ease both;}
    #form-cita h3{color:var(--blue);margin-bottom:15px;}
    #form-cita input,#form-cita select{width:100%;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:var(--radius);transition:border-color .2s;}
    #form-cita input:focus,#form-cita select:focus{outline:none;border-color:var(--blue-light);}
    .productos-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:25px;margin-top:20px;}
    .producto{background:#fff;border-radius:15px;padding:15px;text-align:center;box-shadow:0 4px 12px rgba(0,0,0,.15);transition:transform .3s ease,box-shadow .3s ease;}
    .producto img{width:100%;height:200px;object-fit:cover;border-radius:12px;margin-bottom:12px;}
    .producto h3{margin:10px 0 5px;font-size:1.2em;color:#333;}
    .producto p{font-size:1em;font-weight:bold;color:#666;margin-bottom:10px;}
    .producto:hover{transform:translateY(-8px) scale(1.03);box-shadow:0 8px 20px rgba(0,0,0,.25);}
    footer{background:var(--blue);color:var(--white);text-align:center;padding:30px 20px;margin-top:60px;}
    .ig-btn img{width:36px;margin-top:12px;filter:drop-shadow(0 2px 4px rgba(0,0,0,.25));}
    .reveal{opacity:0;transform:translateY(18px);transition:opacity .6s ease, transform .6s ease;}
    .reveal.visible{opacity:1;transform:translateY(0);}
    @keyframes fadeIn{from{opacity:0}to{opacity:1}}
    @keyframes slideUp{from{transform:translateY(16px);opacity:.6}to{transform:translateY(0);opacity:1}}
    @keyframes fadeInUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
  </style>
</head>
<body>

<!-- HEADER -->
<header class="reveal">
  <h1>✨ Mil y un Cabellos ✨</h1>
  <p>Tu salón de belleza y tienda de productos de confianza</p>
  <?php if(!$logged): ?>
    <button class="btn-login" onclick="abrirModal()">✨ Login / Registro ✨</button>
  <?php else: ?>
    <p>Hola, <?= htmlspecialchars($nombreUser) ?> 👋</p>
  <?php endif; ?>
</header>

<!-- NAV -->
<nav>
  <ul>
    <li><a href="#bienvenida">Inicio</a></li>
    <li><a href="#productos">Productos</a></li>
    <li><a href="#mision">Misión</a></li>
    <li><a href="#vision">Visión</a></li>
    <li><a href="#nosotros">Quiénes somos</a></li>
  </ul>
</nav>

<!-- BIENVENIDA + CARRUSEL -->
<section id="bienvenida" class="reveal">
  <div class="carousel">
    <div class="slides" id="slides">
      <div class="slide" style="background-image:url('https://images.pexels.com/photos/3738349/pexels-photo-3738349.jpeg');"><span>Bienvenid@ a Mil y un Cabellos</span></div>
      <div class="slide" style="background-image:url('https://images.pexels.com/photos/3992873/pexels-photo-3992873.jpeg');"><span>Servicios de belleza de alta calidad</span></div>
      <div class="slide" style="background-image:url('https://images.pexels.com/photos/853427/pexels-photo-853427.jpeg');"><span>Compra productos exclusivos para tu cabello</span></div>
    </div>
    <div class="carousel-buttons">
      <button aria-label="Anterior" onclick="moverSlide(-1)">‹</button>
      <button aria-label="Siguiente" onclick="moverSlide(1)">›</button>
    </div>
  </div>

  <!-- BOTÓN PEDIR CITA -->
  <div style="text-align:center; margin-top:20px;">
    <button class="btn" onclick="mostrarFormulario()">Pedir Cita</button>
  </div>

  <!-- FORMULARIO DE CITA -->
  <?php if($logged): ?>
  <div id="form-cita">
    <h3>Reserva tu cita</h3>
    <form action="cita.php" method="POST">
      <input type="text" name="nombre" placeholder="Tu nombre" value="<?= htmlspecialchars($nombreUser) ?>" required />
      <input type="email" name="correo" placeholder="Tu correo" required />
      <select name="servicio" required>
        <option value="">Selecciona un servicio</option>
        <option>Corte de cabello</option>
        <option>Coloración</option>
        <option>Alisado / Planchado</option>
        <option>Keratina</option>
        <option>Peinados</option>
      </select>
      <input type="date" name="fecha" required />
      <button type="submit" class="btn">Enviar</button>
    </form>
  </div>
  <?php endif; ?>
</section>

<!-- PRODUCTOS -->
<section id="productos" class="reveal">
  <h2>Servicios y Productos</h2>
  <div class="productos-grid">
    <div class="producto"><img src="https://images.pexels.com/photos/3993444/pexels-photo-3993444.jpeg" alt="Alisado Permanente"><h3>Alisado Permanente</h3><p>$120.000 COP</p></div>
    <div class="producto"><img src="https://images.pexels.com/photos/3993445/pexels-photo-3993445.jpeg" alt="Tintura Profesional"><h3>Tintura Profesional</h3><p>$80.000 COP</p></div>
    <div class="producto"><img src="https://images.pexels.com/photos/3993446/pexels-photo-3993446.jpeg" alt="Corte de Cabello"><h3>Corte de Cabello</h3><p>$40.000 COP</p></div>
    <div class="producto"><img src="https://images.pexels.com/photos/3993447/pexels-photo-3993447.jpeg" alt="Tratamiento Capilar"><h3>Tratamiento Capilar</h3><p>$60.000 COP</p></div>
    <div class="producto"><img src="https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg" alt="Mascarilla Nutritiva"><h3>Mascarilla Nutritiva</h3><p>$30.000 COP</p></div>
  </div>
</section>

<!-- MISION -->
<section id="mision" class="reveal"><h2>Misión</h2><p style="max-width:800px;margin:auto;text-align:center;">Brindar servicios de belleza y productos de alta calidad para realzar la confianza y el estilo de cada persona, con un equipo humano apasionado que ofrece experiencias memorables en cada visita.</p></section>

<!-- VISION -->
<section id="vision" class="reveal"><h2>Visión</h2><p style="max-width:800px;margin:auto;text-align:center;">Convertirnos en el salón de belleza líder en innovación y confianza, expandiendo nuestra presencia y siendo referentes en cuidado capilar y atención al cliente.</p></section>

<!-- NOSOTROS -->
<section id="nosotros" class="reveal"><h2>Quiénes Somos</h2><p style="max-width:800px;margin:auto;text-align:center;">En Mil y un Cabellos somos un equipo de profesionales apasionados por la belleza y el cuidado personal. Nos mueve la creatividad, la técnica y el trato cercano para que cada cliente se sienta único.</p></section>

<!-- FOOTER -->
<footer class="reveal"><p>Desarrollado por Federico Pérez © 2025</p><a href="https://www.instagram.com/milyuncabellos" target="_blank" class="ig-btn"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" /></a></footer>

<!-- MODAL LOGIN/REGISTER -->
<?php if(!$logged): ?>
<div class="modal" id="modal">
  <div class="modal-content">
    <h3 id="modal-title">Login</h3>
    <!-- LOGIN -->
    <form id="form-login" action="login.php" method="POST">
      <input type="email" name="correo" placeholder="Correo" required />
      <input type="password" name="contrasena" placeholder="Contraseña" required />
      <button class="btn" type="submit">Entrar</button>
    </form>
    <!-- REGISTRO -->
    <form id="form-register" action="registro.php" method="POST" style="display:none;">
      <input type="text" name="nombre" placeholder="Usuario" required />
      <input type="email" name="correo" placeholder="Correo" required />
      <input type="password" name="contrasena" placeholder="Contraseña" required />
      <select name="rol" required>
        <option value="cliente">Cliente</option>
        <option value="admin">Administrador</option>
      </select>
      <button class="btn" type="submit">Registrar</button>
    </form>
    <p style="margin-top:10px;"><a href="#" onclick="toggleForms(); return false;">¿No tienes cuenta? Regístrate</a></p>
  </div>
  <span class="close" onclick="cerrarModal()">×</span>
</div>
<?php endif; ?>

<script>
/* CARRUSEL */
let idx=0;
function moverSlide(dir){
  const slides=document.getElementById('slides');
  const total=slides.children.length;
  idx=(idx+dir+total)%total;
  slides.style.transform=`translateX(${-idx*100}%)`;
}
setInterval(()=>moverSlide(1),5000);

/* MODAL */
function abrirModal(){document.getElementById("modal").style.display="flex";}
function cerrarModal(){document.getElementById("modal").style.display="none";}
function toggleForms(){
  let loginF=document.getElementById("form-login"), regF=document.getElementById("form-register"), title=document.getElementById("modal-title");
  if(loginF.style.display==="none"){loginF.style.display="block"; regF.style.display="none"; title.innerText="Login";}else{loginF.style.display="none"; regF.style.display="block"; title.innerText="Registro";}
}

/* Mostrar formulario cita */
function mostrarFormulario(){
  <?php if($logged): ?>
    const form=document.getElementById('form-cita');
    if(form){
      form.style.display='block';
      form.scrollIntoView({behavior:'smooth'});
    }
  <?php else: ?>
    alert("Debes iniciar sesión para pedir una cita");
    abrirModal();
  <?php endif; ?>
}

/* REVEAL ON SCROLL */
const revealEls=document.querySelectorAll('.reveal');
const io=new IntersectionObserver(entries=>{entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('visible');io.unobserve(entry.target);}})},{threshold:0.12});
revealEls.forEach(el=>io.observe(el));
</script>
</body>
</html>


