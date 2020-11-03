<?php

require_once('..\inc\funciones.php');

$a_categorias=[
    1 =>[
        "id_producto" => 1,
        "nombre" => "Hombre"
    ],
    2 =>[
        "id_producto" => 2,
        "nombre" => "Mujer"
    ],
    3 =>[
        "id_producto" => 3,
        "nombre" => "Kid"
    ]
];
$a_productos=[
    1 => [
        "id_producto" => 1,
        "modelo" => "Legacy",
        "marca" => "DC",
        "precio" => 7000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ],
    2 => [
        "id_producto" => 2,
        "modelo" => "Air Max Be",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ],
    3 => [
        "id_producto" => 3,
        "modelo" => "NMD R1",
        "marca" => "Adidas",
        "precio" => 6000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ],
    4 => [
        "id_producto" => 4,
        "modelo" => "Air Force Pi",
        "marca" => "Nike",
        "precio" => 7500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ],
    5 => [
        "id_producto" => 5,
        "modelo" => "Air Max R",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    6 => [
        "id_producto" => 6,
        "modelo" => "Air Max Y",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    7 => [
        "id_producto" => 7,
        "modelo" => "Air Max B",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    8 => [
        "id_producto" => 8,
        "modelo" => "Air Max G",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    9 => [
        "id_producto" => 9,
        "modelo" => "Disruptor",
        "marca" => "Fila",
        "precio" => 7500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 3
    ],
    10 => [
        "id_producto" => 10,
        "modelo" => "Pure Black",
        "marca" => "DC",
        "precio" => 6000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 3
    ],
    11 => [
        "id_producto" => 11,
        "modelo" => "Old School",
        "marca" => "Vans",
        "precio" => 5500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ],
    12 => [
        "id_producto" => 12,
        "modelo" => "Function",
        "marca" => "Adidas",
        "precio" => 6500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    13 => [
        "id_producto" => 13,
        "modelo" => "Dunk B",
        "marca" => "Nike",
        "precio" => 7500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 3
    ],
    14 => [
        "id_producto" => 14,
        "modelo" => "SB Bold",
        "marca" => "Nike",
        "precio" => 8000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 3
    ],
    15 => [
        "id_producto" => 15,
        "modelo" => "Gray",
        "marca" => "Adidas",
        "precio" => 6500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    16 => [
        "id_producto" => 16,
        "modelo" => "Dunk W",
        "marca" => "Nike",
        "precio" => 7000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    17 => [
        "id_producto" => 17,
        "modelo" => "SB B",
        "marca" => "Nike",
        "precio" => 7000,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    18 => [
        "id_producto" => 18,
        "modelo" => "Classic",
        "marca" => "Adidas",
        "precio" => 6500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 1
    ],
    19 => [
        "id_producto" => 19,
        "modelo" => "Nice Dark",
        "marca" => "DC",
        "precio" => 7500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 3
    ],
    20 => [
        "id_producto" => 20,
        "modelo" => "Fila",
        "marca" => "Curve",
        "precio" => 7500,
        "descripcion" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit numquam tenetur maiores molestiae",
        "id_categoria" => 2
    ]  
 ];
 

GuardarArrayEnJson('json','productos.json',$a_productos);
GuardarArrayEnJson('json','categorias.json',$a_categorias);

 ?>
