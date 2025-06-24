-- Tabla de usuarios (solo un admin)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL
);

-- Para generar el hash correcto en PHP usa:
-- <?php echo password_hash('Luis200180', PASSWORD_BCRYPT); ?>
-- Ejemplo de insert con hash real:
-- INSERT INTO usuarios (email, password, nombre) VALUES ('luisgarita663@gmail.com', '$2y$10$...', 'Administrador');

-- Usuario admin (contraseña en texto plano: Luis200180)
INSERT INTO usuarios (email, password, nombre) VALUES
('luisgarita663@gmail.com', 'Luis200180', 'Administrador');

-- Tabla de categorías (ahora con subcategorías)
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('comida','bebida','promocion') NOT NULL,
    parent_id INT DEFAULT NULL,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (parent_id) REFERENCES categorias(id) ON DELETE SET NULL
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    categoria_id INT,
    habilitado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla de promociones
CREATE TABLE IF NOT EXISTS promociones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen VARCHAR(255),
    habilitado TINYINT(1) DEFAULT 1
); 