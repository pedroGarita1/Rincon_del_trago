-- Script para actualizar la base de datos existente
-- Ejecutar este script si ya tienes datos en la base de datos

USE rincon_del_trago;

-- Agregar columna descripcion si no existe
ALTER TABLE categorias ADD COLUMN IF NOT EXISTS descripcion TEXT;

-- Actualizar descripciones de categorías existentes
UPDATE categorias SET descripcion = 'Paquetes especiales con alitas y papas' WHERE nombre = 'Paquetes Espaciales';
UPDATE categorias SET descripcion = 'Combos temáticos para cada día de la semana' WHERE nombre = 'Combos Diarios';
UPDATE categorias SET descripcion = 'Platillos principales y acompañamientos' WHERE nombre = 'Comida Galáctica';
UPDATE categorias SET descripcion = 'Variedad de bebidas y cócteles' WHERE nombre = 'Bebidas del Cosmos';

-- Actualizar descripciones de subcategorías de bebidas
UPDATE categorias SET descripcion = 'Cervezas nacionales e importadas, vinos frutales y paquetes especiales' WHERE nombre = 'Cervezas y Vinos Frutales';
UPDATE categorias SET descripcion = 'Botellas de licores premium con mixers incluidos' WHERE nombre = 'Botellas del Universo';
UPDATE categorias SET descripcion = 'Cócteles artesanales y tragos especiales de la casa' WHERE nombre = 'Tragos Estelares'; 