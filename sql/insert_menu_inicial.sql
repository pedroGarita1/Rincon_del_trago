-- Agregar columna descripcion si no existe
ALTER TABLE categorias ADD COLUMN IF NOT EXISTS descripcion TEXT;

-- Limpiar datos existentes (opcional - comentar si no quieres borrar)
-- DELETE FROM productos;
-- DELETE FROM promociones;
-- DELETE FROM categorias;

-- Categorías principales y subcategorías
INSERT INTO categorias (nombre, tipo, parent_id, descripcion) VALUES
('Paquetes Espaciales', 'promocion', NULL, 'Paquetes especiales con alitas y papas'),
('Combos Diarios', 'promocion', NULL, 'Combos temáticos para cada día de la semana'),
('Comida Galáctica', 'comida', NULL, 'Platillos principales y acompañamientos'),
('Bebidas del Cosmos', 'bebida', NULL, 'Variedad de bebidas y cócteles');

-- Subcategorías de bebidas (parent_id apunta a 'Bebidas del Cosmos')
INSERT INTO categorias (nombre, tipo, parent_id, descripcion) VALUES
('Cervezas y Vinos Frutales', 'bebida', 4, 'Cervezas nacionales e importadas, vinos frutales y paquetes especiales'),
('Botellas del Universo', 'bebida', 4, 'Botellas de licores premium con mixers incluidos'),
('Tragos Estelares', 'bebida', 4, 'Cócteles artesanales y tragos especiales de la casa');

-- Productos (Comida)
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id) VALUES
('Boneless', 'Pollo Crujiente Intergaláctico', 110.00, 'boneless.jpg', 3),
('Dedos de Queso', 'Varitas de Oro Derretido', 136.00, 'dedos.webp', 3),
('Alitas Picositas', 'Dragones en Llamas', 130.00, 'alitasBBQ.png', 3),
('Alitas Buffalo', 'Tormenta de Búfalo', 140.00, 'alitasBuffalo.jpg', 3),
('Alitas BBQ Miel', 'Abejas Atómicas', 155.00, 'alitasBBQMiel.jpeg', 3),
('Papas Clásicas', 'Asteroide Crujiente', 60.00, 'papasFrancesas.jpg', 3),
('Papas Onduladas', 'Tornado de Sabores', 60.00, 'papasOnduladas.jpeg', 3);

-- Productos (Bebidas: Cervezas y Vinos Frutales)
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id) VALUES
('La Victoria Clásica', 'Victoria 473ml', 30.00, 'Cervezas.jpg', 5),
('Modelo Dorada', 'Modelo Especial 473ml', 30.00, 'Cervezas.jpg', 5),
('Indio Brava', 'Indio 473ml', 28.00, 'Cervezas.jpg', 5),
('Palomita Mix', 'New Mix Paloma 473ml', 28.00, 'Cervezas.jpg', 5),
('Modelo Especial Chica', '355ml', 25.00, 'Cervezas.jpg', 5),
('Negra Legendaria', 'Negra Modelo 355ml', 25.00, 'Cervezas.jpg', 5),
('Coronita Playera', 'Corona 210ml', 20.00, 'Cervezas.jpg', 5),
('Victoria Mini', 'Victoria 210ml', 20.00, 'Cervezas.jpg', 5),
('Indio Flecha', 'Indio 190ml', 18.00, 'Cervezas.jpg', 5),
('Victoria Gigante', 'Mega', 50.00, 'Cervezas.jpg', 5),
('Corona XXL', 'Mega', 50.00, 'Cervezas.jpg', 5),
('Modelo Especial MAX', 'Mega', 50.00, 'Cervezas.jpg', 5),
('Negra Modelo Colosal', 'Mega', 55.00, 'Cervezas.jpg', 5),
('Torito Alemán', 'Gaffel 5L', 700.00, 'Cervezas.jpg', 5),
('Keller Oscuro', 'Denninghoffs 5L', 700.00, 'Cervezas.jpg', 5),
('El Naufragio', '5 cervezas nacionales', 100.00, 'Cervezas.jpg', 5),
('Marea Roja', '8 cervezas', 150.00, 'Cervezas.jpg', 5),
('El Titanic', '10 cervezas', 200.00, 'Cervezas.jpg', 5),
('Blueberry Bliss', 'Viña Blueberry 400ml', 25.00, 'Cervezas.jpg', 5),
('Dulce Melocotón', 'Viña Durazno 400ml', 25.00, 'Cervezas.jpg', 5),
('Fresa Salvaje', 'Viña Fresa-Sandía 400ml', 25.00, 'Cervezas.jpg', 5);

-- Productos (Bebidas: Botellas del Universo)
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id) VALUES
('Tesoro Añejado', 'Bacardí Añejo + 2 Coca-Cola', 380.00, 'BotellasUniverso.jpg', 6),
('Blancura Cósmica', 'Bacardí Carta Blanca + 2 Sprite', 340.00, 'BotellasUniverso.jpg', 6),
('Blanco Redux', 'Bacardí Carta Blanca 700ml + 2 Sprite', 286.00, 'BotellasUniverso.jpg', 6),
('Mango Explosivo', 'Bacardí Mango Chile + 2 Tónica', 286.00, 'BotellasUniverso.jpg', 6),
('Frambuesa Helada', 'Absolut Raspberri + 2 Sprite', 380.00, 'BotellasUniverso.jpg', 6),
('Espejo de Hielo', 'Absolut Vodka + 2 Tónica', 350.00, 'BotellasUniverso.jpg', 6),
('Gigante de Cristal', 'Zaverich 1.75L + 2 Coca-Cola', 280.00, 'BotellasUniverso.jpg', 6),
('Lago de Vodka', 'Zaverich 1L + 2 Coca-Cola', 220.00, 'BotellasUniverso.jpg', 6),
('Oso de las Nieves', 'Oso Negro + 2 Jugos Toronja', 300.00, 'BotellasUniverso.jpg', 6),
('Reina de la Nieve', 'Wyborowa + 2 Tónica', 250.00, 'BotellasUniverso.jpg', 6),
('Rancho Secreto', 'Rancho Escondido + 2 Squirt', 250.00, 'BotellasUniverso.jpg', 6),
('El Jimador', 'Jimador + 2 Squirt', 362.00, 'BotellasUniverso.jpg', 6),
('Cuervo Dorado', 'José Cuervo Tradicional + 2 Coca-Cola', 382.00, 'BotellasUniverso.jpg', 6),
('Cuervo Gigante', 'José Cuervo 950ml + 2 Coca-Cola', 506.00, 'BotellasUniverso.jpg', 6),
('Azul Profundo', 'Azul + 2 Sangrita', 220.00, 'BotellasUniverso.jpg', 6),
('Plata Líquida', 'José Cuervo Plata + 2 Squirt', 550.00, 'BotellasUniverso.jpg', 6),
('Centuria Legendaria', 'Centenario 700ml + 2 Coca-Cola', 350.00, 'BotellasUniverso.jpg', 6),
('Centuria Suprema', 'Centenario 950ml + 2 Coca-Cola', 400.00, 'BotellasUniverso.jpg', 6),
('Plata Pura', 'Centenario Plata + 2 Agua Mineral', 500.00, 'BotellasUniverso.jpg', 6),
('Equilibrio Divino', 'Ballantines + 2 Squirt', 325.00, 'BotellasUniverso.jpg', 6),
('Don de los Dioses', 'Don Julio + 2 Sangrita', 1350.00, 'BotellasUniverso.jpg', 6),
('1800 Años Luz', '1800 + 2 Coca-Cola', 880.00, 'BotellasUniverso.jpg', 6),
('Jack el Destripador', 'Jack Daniel''s + 2 Coca-Cola', 500.00, 'BotellasUniverso.jpg', 6),
('Miel de Tennessee', 'Jack Daniel''s Honey + 2 Té Helado', 520.00, 'BotellasUniverso.jpg', 6),
('Torres del Cielo', 'Torres 10 + 2 Tónica', 350.00, 'BotellasUniverso.jpg', 6),
('Sangre de Uva', 'Cabernet Sauvignon', 180.00, 'BotellasUniverso.jpg', 6),
('Cuatro Soles Rojo', 'Cuatro Soles Cabernet', 200.00, 'BotellasUniverso.jpg', 6),
('Cuatro Soles Negro', 'Cuatro Soles Merlot', 250.00, 'BotellasUniverso.jpg', 6),
('Champaña de Reyes', 'Moët & Chandon', 1800.00, 'BotellasUniverso.jpg', 6),
('Rosa de Chandon', 'VE Chandon Rosé', 600.00, 'BotellasUniverso.jpg', 6),
('Delicia Dorada', 'VE Chandon Delice', 650.00, 'BotellasUniverso.jpg', 6),
('Lujo Burbujeante', 'Luxe Belaire', 1000.00, 'BotellasUniverso.jpg', 6);

-- Productos (Bebidas: Tragos Estelares)
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id) VALUES
('Rayos de Sol', 'Destornillador - Vodka + Jugo de Naranja', 90.00, 'TragosEspectrales.jpg', 7),
('Hierba Lunar', 'Mojito - Ron + Menta + Limón', 85.00, 'TragosEspectrales.jpg', 7),
('Océano Azul', 'Azulito - Tequila Azul + Cítricos', 85.00, 'TragosEspectrales.jpg', 7),
('Canto de Sirena', 'Cantarito - Tequila + Cítricos', 80.00, 'TragosEspectrales.jpg', 7),
('Aleteo de Toronja', 'Paloma - Tequila + Toronja', 80.00, 'TragosEspectrales.jpg', 7),
('Humo Mágico', 'Sabina - Mezcal + Cítricos', 90.00, 'TragosEspectrales.jpg', 7),
('Jardín de Baco', 'Clericó - Vino Blanco + Frutas', 90.00, 'TragosEspectrales.jpg', 7),
('Tormenta de Sabores', 'Michelada', 90.00, 'TragosEspectrales.jpg', 7),
('Nube Tropical', 'Piña Colada - Ron + Crema de Coco', 90.00, 'TragosEspectrales.jpg', 7),
('Pecera de los Dioses', 'Peceras - Cerveza + Jugos', 90.00, 'TragosEspectrales.jpg', 7);

-- Promociones (Paquetes y Combos)
INSERT INTO promociones (nombre, descripcion, precio, imagen) VALUES
('Alitas + Papas', 'Cohete Picante: 1/3 kg Alitas Buffalo + 1/3 kg Papas', 180.00, NULL),
('Alitas + Papas', 'Nave BBQ: 2/3 kg Alitas BBQ + 1/3 kg Papas', 350.00, NULL),
('Alitas + Papas', 'Mega Nave Infernal: 1 kg Alitas Picositas + 1 kg Papas', 450.00, NULL),
('Boneless + Papas', 'Misión Crujiente: 1/3 kg Boneless + 1/3 kg Papas', 150.00, NULL),
('Boneless + Papas', 'Nave de Combate: 2/3 kg Boneless + 2/3 kg Papas', 300.00, NULL),
('Boneless + Papas', 'Destructor de Hambre: 1 kg Boneless + 1 kg Papas', 450.00, NULL),
('Martes de Fuego', '1 kg Boneless (BBQ) + 1L Michelada Tradicional o Cubana', 380.00, NULL),
('Miércoles de Alitas Locas', '1 kg Alitas (BBQ Miel o Buffalo) + 1L Clericó o Piña Colada', 400.00, NULL),
('Jueves de Queso Fundido', '1 kg Dedos de Queso + ½L Destornillador (Rayos de Sol)', 450.00, NULL),
('Viernes de Borrachera Galáctica', '1 Botella de Ron (Bacardí Carta Blanca + 2 Sprite) + 1 kg Papas Onduladas + 1L Mojito (Hierba Lunar)', 600.00, NULL),
('Sábado de Carnes y Whisky', '1 kg Alitas Buffalo + 1 Botella de Jack Daniel''s (+ 2 Coca-Cola) + 1 kg Papas Francesas', 1100.00, NULL),
('Domingo de Champaña y Brunch', '1 Botella de VE Chandon Rosé o Delice + 1 kg Dedos de Queso + 1L Clericó (Jardín de Baco)', 970.00, NULL); 