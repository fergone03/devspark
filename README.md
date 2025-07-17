<div align="left" style="position: relative;">
<img src="https://cdn-icons-png.flaticon.com/512/6295/6295417.png" align="right" width="30%" style="margin: -20px 0 0 20px;">
<h1>DEVSPARK</h1>
<p align="left">
	<em><code>❯ DevSpark</code></em>
</p>
<p align="left">
	<img src="https://img.shields.io/github/license/fergone03/devspark?style=flat&logo=opensourceinitiative&logoColor=white&color=0080ff" alt="license">
	<img src="https://img.shields.io/github/last-commit/fergone03/devspark?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
	<img src="https://img.shields.io/github/languages/top/fergone03/devspark?style=flat&color=0080ff" alt="repo-top-language">
	<img src="https://img.shields.io/github/languages/count/fergone03/devspark?style=flat&color=0080ff" alt="repo-language-count">
</p>
<p align="left">Built with the tools and technologies:</p>
<p align="left">
	<img src="https://img.shields.io/badge/HTML5-E34F26.svg?style=flat&logo=HTML5&logoColor=white" alt="HTML5">
	<img src="https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=flat&logo=JavaScript&logoColor=black" alt="JavaScript">
	<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">
</p>
</div>
<br clear="right">

## Índice de contenidos

- [ Descripción general](#-overview)
- [ Características principales](#-features)
- [ Estructura del proyecto](#-project-structure)
  - [ Índice del proyecto](#-project-index)
- [ Comencemos](#-getting-started)
  - [ Prerequisitos](#-prerequisites)
  - [ Instalación](#-installation)
  - [ Uso](#-usage)
  - [ Pruebas](#-testing)
- [ Próximas mejoras](#-project-roadmap)
---

## Descripción general

Esta es una web de gestión para una empresa de desarrollo de software y páginas web para clientes. Permite la gestión de proyectos y usuarios con diferentes roles.

- Login para dos tipos de roles: administrador y trabajador.
- El administrador puede crear, ver, actualizar y eliminar proyectos.
- Los trabajadores solo pueden ver los proyectos asociados a ellos.
- Interfaz moderna con Bootstrap.
- Seguridad: contraseñas cifradas y saneamiento de entradas.

---

## Características principales

- Gestión de usuarios y proyectos.
- Roles diferenciados (admin/trabajador).
- Peticiones Ajax y uso de JavaScript moderno.
- Backend en PHP y MySQL/MariaDB.
- Estructura modular y segura.

---

## Estructura del proyecto

```sh
└── devspark/
    ├── Práctica subida de nota DAW 24-25.pdf
    ├── README.md
    ├── app.js
    ├── dashboard.php
    ├── estructura.sql
    ├── index.html
    ├── login.html
    ├── login.php
    ├── logout.php
    ├── proyectos.php
    ├── register.html
    ├── register.php
    ├── spark-svgrepo-com.svg
    ├── styles.css
    └── usuarios.php
```


###  Índice del proyecto
<details open>
	<summary><b><code>DEVSPARK/</code></b></summary>
	<details> <!-- __root__ Submodule -->
		<summary><b>__root__</b></summary>
		<blockquote>
			<table>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/register.html'>register.html</a></b></td>
				<td>Formulario de registro de nuevos usuarios.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/estructura.sql'>estructura.sql</a></b></td>
				<td>Estructura de la base de datos del proyecto.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/app.js'>app.js</a></b></td>
				<td>Script principal de la aplicación (JavaScript).</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/dashboard.php'>dashboard.php</a></b></td>
				<td>Página de inicio del dashboard (solo admin).</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/register.php'>register.php</a></b></td>
				<td>Script PHP para registrar nuevos usuarios.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/proyectos.php'>proyectos.php</a></b></td>
				<td>Muestra y gestiona los proyectos de la empresa.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/login.html'>login.html</a></b></td>
				<td>Formulario de acceso de usuarios (login).</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/login.php'>login.php</a></b></td>
				<td>Script PHP para autenticar usuarios y gestionar la sesión.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/logout.php'>logout.php</a></b></td>
				<td>Cierra la sesión del usuario y redirige al login.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/index.html'>index.html</a></b></td>
				<td>Página de presentación/inicio del proyecto.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/styles.css'>styles.css</a></b></td>
				<td>Estilos CSS personalizados para la web.</td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/fergone03/devspark/blob/master/usuarios.php'>usuarios.php</a></b></td>
				<td>Gestión y consulta de usuarios (solo admin).</td>
			</tr>
			</table>
		</blockquote>
	</details>
</details>

---
##  Comencemos

###  Prerequisitos

Before getting started with devspark, ensure your runtime environment meets the following requirements:

- **Lenguajes de programación:** PHP, HTML5, CSS3, JavaScript
- **Base de datos:** MySQL/MariaDB
- **Servidor web:** Apache
- **Frameworks:** Bootstrap

### Uso

#### 1. Crear la base de datos

```sql
CREATE DATABASE empresa_dev CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 2. Importar la estructura
Utiliza el archivo `estructura.sql` incluido en este repositorio para crear las tablas necesarias.

**Opción A: Con phpMyAdmin**
- Accede a phpMyAdmin.
- Selecciona la base de datos `empresa_dev`.
- Ve a la pestaña Importar y sube el archivo `estructura.sql`.

**Opción B: Por consola**
```bash
mysql -u root -p empresa_dev < estructura.sql
```

#### 3. Configuración del servidor

**Opción A: Servidor embebido de PHP (recomendado para desarrollo rápido)**
```bash
cd ruta/del/proyecto/subida-de-nota
php -S localhost:3000
```
Accede desde el navegador a:
```
http://localhost:3000/index.html
```

**Opción B: XAMPP / Apache**
- Copia el proyecto en `C:\xampp\htdocs\subida-de-nota`
- Inicia Apache y MySQL desde el panel de XAMPP.
- Abre en el navegador:
```
http://localhost/subida-de-nota/index.html
```

#### 4. Configuración de conexión a base de datos
Los scripts PHP (`register.php`, `login.php`, etc.) usan la siguiente configuración por defecto:

```php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'empresa_dev';
```

#### ⚠️ Si tus credenciales son diferentes, modifícalas en los archivos PHP correspondientes.

- Abre register.html DESDE URL para crear una cuenta nueva.

- Accede luego a DESDE URL login.html para iniciar sesión.

- Serás redirigido a dashboard.php al autenticarte correctamente.

- Usar logout.php para cerrar sesión.

- Para crear un usuario admin:
   - Abre phpMyAdmin.
   - Selecciona la base de datos `empresa_dev`.
   - Encuentra la tabla `usuarios` y agrega un nuevo registro con:
   - nombre: admin
   - email: admin@admin.com
   - password: admin
   - rol: admin
   - o en un usuario ya creado cambia el rol a admin


---
## Próximas mejoras

- [ ] **`Task 1`**: Mejorar la interfaz de usuario para una vista más moderna y empresarial.

---