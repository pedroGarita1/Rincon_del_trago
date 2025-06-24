-- Agregar columna descripción a la tabla categorías
ALTER TABLE categorias ADD COLUMN descripcion TEXT;

-- Actualizar descripciones de las subcategorías de bebidas
UPDATE categorias SET descripcion = 'Cervezas nacionales e importadas, vinos frutales y paquetes especiales' WHERE id = 5;
UPDATE categorias SET descripcion = 'Botellas de licores premium con mixers incluidos' WHERE id = 6;
UPDATE categorias SET descripcion = 'Cócteles artesanales y tragos especiales de la casa' WHERE id = 7; 