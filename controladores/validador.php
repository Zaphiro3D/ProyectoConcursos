<?php

class validador
{   
    //Validación de espacios vacíos
    public function string ($value)
    {
        return strlen(trim($value)) === 0;
    }

    //Validación de teléfono
    public function telefono($telefono)
    {
        // Elimina espacios, guiones y paréntesis para normalizar
        $telefono = preg_replace('/[\s\-\(\)]/', '', $telefono);

        // Validar prefijo internacional opcional (+54) y número de 10-11 dígitos
        // ^ y $: Aseguran que la validación abarque todo el número.
        // (\+54)?: Permite que el número incluya o no el prefijo internacional +54.
        // [1-9]: El número no puede comenzar con 0.
        // \d{9}: Exige exactamente 9 dígitos adicionales después del código de área, totalizando 10 dígitos.
        
        if (preg_match('/^(\+54)?[1-9]\d{9}$/', $telefono)) {
            return true; // Es un número válido
        }

        return false; // Número inválido
    }

    //Validación de DNI
    public function dni($dni)
    {
        // Elimina puntos o espacios
        $dni = preg_replace('/[^\d]/', '', $dni);

        // Validar longitud y que sean solo números
        if (preg_match('/^\d{7,8}$/', $dni)) {
            return true; // DNI válido
        }

        return false; // DNI inválido
    }
}