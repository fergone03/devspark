-- Estructura base para DevSpark (PHP + MySQL)

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Hasheada con password_hash
    rol ENUM('admin','trabajador') NOT NULL
);

CREATE TABLE proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    trabajador_id INT,
    FOREIGN KEY (trabajador_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Usuario admin de ejemplo (cambia el hash por uno real generado con password_hash)
INSERT INTO users (nombre, email, password, rol) VALUES
('Admin Ejemplo', 'admin@devspark.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 'admin');
