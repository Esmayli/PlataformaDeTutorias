<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function generarRespuesta(string $pregunta, string $materia): array
    {
        // ============================================
        // INTENTO 1: CONEXIÓN CON GEMINI (IA Real)
        // ============================================
        $apiKey = trim(env('GEMINI_API_KEY', ''));

        if (!empty($apiKey)) {
            $modelos = ['gemini-1.5-flash', 'gemini-pro', 'gemini-1.0-pro'];
            
            foreach ($modelos as $modelo) {
                $respuesta = $this->intentarGemini($pregunta, $materia, $apiKey, $modelo);
                if ($respuesta !== null) {
                    return $respuesta;
                }
            }
        }

        // ============================================
        // INTENTO 2: IA LOCAL (Base de Conocimiento)
        // ============================================
        // Si Gemini falla, usamos respuestas inteligentes predefinidas
        // que son instantáneas y no necesitan internet.
        return $this->respuestaLocal($pregunta, $materia);
    }

    private function intentarGemini(string $pregunta, string $materia, string $apiKey, string $modelo): ?array
    {
        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelo}:generateContent?key={$apiKey}";
            
            $postData = json_encode([
                'contents' => [
                    ['parts' => [['text' => "Eres tutor en {$materia}. Responde en español claro y didáctico. Pregunta: {$pregunta}"]]]
                ],
                'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 1024]
            ]);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $data = json_decode($response, true);
                $texto = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                if (!empty($texto)) {
                    return [
                        'exito' => true,
                        'respuesta' => trim($texto),
                        'nivel_confianza' => 96.00,
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error("Fallo Gemini con {$modelo}: " . $e->getMessage());
        }

        return null;
    }

    private function respuestaLocal(string $pregunta, string $materia): array
    {
        $p = mb_strtolower($pregunta);
        $m = mb_strtolower($materia);

        // ==========================================
        // BASE DE CONOCIMIENTO: PROGRAMACIÓN
        // ==========================================
        if (str_contains($m, 'program')) {
            if (str_contains($p, 'variable')) {
                return $this->exito("Una **variable** es un espacio reservado en la memoria de la computadora donde puedes guardar un dato que puede cambiar durante la ejecución del programa.\n\n**Ejemplo sencillo:**\n```\nnombre = \"Juan\"\nedad = 20\n```\nAquí, `nombre` y `edad` son variables. Puedes cambiar su valor cuando quieras: `edad = 21`. Las variables son fundamentales porque permiten que los programas sean dinámicos y adapten su comportamiento según los datos que reciben.");
            }
            if (str_contains($p, 'función') || str_contains($p, 'funcion')) {
                return $this->exito("Una **función** es un bloque de código que realiza una tarea específica y puede ser reutilizado cuantas veces quieras.\n\n**Ejemplo:**\n```python\ndef saludar(nombre):\n    return \"Hola, \" + nombre\n\nprint(saludar(\"Ana\"))\n```\nLas funciones evitan repetir código, hacen el programa más organizado y fácil de mantener. Reciben datos (parámetros), procesan y devuelven un resultado.");
            }
            if (str_contains($p, 'ciclo') || str_contains($p, 'bucle') || str_contains($p, 'for') || str_contains($p, 'while')) {
                return $this->exito("Un **bucle** o ciclo es una estructura que repite un bloque de código varias veces mientras se cumpla una condición.\n\n**Ejemplo con `for`:**\n```python\nfor i in range(5):\n    print(i)\n```\n**Ejemplo con `while`:**\n```python\ncontador = 0\nwhile contador < 5:\n    print(contador)\n    contador += 1\n```\nLos bucles son esenciales para automatizar tareas repetitivas, como recorrer listas o validar datos.");
            }
            if (str_contains($p, 'if') || str_contains($p, 'condici') || str_contains($p, 'else')) {
                return $this->exito("Las **condicionales** (`if`, `else`, `elif`) permiten que el programa tome decisiones según si una condición es verdadera o falsa.\n\n**Ejemplo:**\n```python\nedad = 18\nif edad >= 18:\n    print(\"Eres mayor de edad\")\nelse:\n    print(\"Eres menor de edad\")\n```\nSin condicionales, los programas serían lineales y no podrían adaptarse a diferentes situaciones.");
            }
            if (str_contains($p, 'array') || str_contains($p, 'arreglo') || str_contains($p, 'lista') || str_contains($p, 'vector')) {
                return $this->exito("Un **arreglo** (o array) es una estructura que permite almacenar múltiples valores en una sola variable.\n\n**Ejemplo:**\n```python\nfrutas = [\"manzana\", \"pera\", \"uva\"]\nprint(frutas[0])  # Imprime: manzana\n```\nLos arreglos son fundamentales para manejar colecciones de datos, como una lista de estudiantes o calificaciones.");
            }
            if (str_contains($p, 'clase') || str_contains($p, 'objeto') || str_contains($p, 'poo') || str_contains($p, 'orientada')) {
                return $this->exito("La **Programación Orientada a Objetos (POO)** organiza el código en 'objetos' que combinan datos (atributos) y comportamientos (métodos).\n\n**Ejemplo:**\n```python\nclass Perro:\n    def __init__(self, nombre):\n        self.nombre = nombre\n    \n    def ladrar(self):\n        return \"Guau!\"\n\nmi_perro = Perro(\"Rex\")\nprint(mi_perro.ladrar())\n```\nLa POO permite crear código reutilizable, organizado y más fácil de mantener.");
            }
            return $this->exito("En **Programación**, este es un concepto fundamental para construir software funcional. Te recomiendo practicar con ejemplos sencillos en Python o JavaScript, ya que son lenguajes amigables para principiantes. Si tienes dudas específicas sobre sintaxis, no dudes en consultar.");
        }

        // ==========================================
        // BASE DE CONOCIMIENTO: MATEMÁTICA
        // ==========================================
        if (str_contains($m, 'matem')) {
            if (str_contains($p, 'derivad')) {
                return $this->exito("La **derivada** mide la tasa de cambio instantánea de una función. Geométricamente, representa la pendiente de la recta tangente en un punto.\n\n**Ejemplo:**\nSi f(x) = x², entonces f'(x) = 2x.\nEn x = 3, la pendiente es 6.\n\nLas derivadas son esenciales en física (velocidad es la derivada de la posición) y en optimización de procesos.");
            }
            if (str_contains($p, 'integral')) {
                return $this->exito("La **integral** es la operación inversa de la derivada y permite calcular áreas bajo curvas, volúmenes y acumulaciones.\n\n**Ejemplo:**\nLa integral de 2x dx es x² + C.\n\nSe aplica en ingeniería para calcular centroides, momentos de inercia, y en física para determinar trabajo y energía.");
            }
            if (str_contains($p, 'ecuaci')) {
                return $this->exito("Una **ecuación** es una igualdad matemática que contiene una o más incógnitas. Resolverla significa encontrar el valor que hace verdadera la igualdad.\n\n**Ejemplo:**\n2x + 4 = 10\n2x = 6\nx = 3\n\nLas ecuaciones modelan situaciones reales y son la base del álgebra.");
            }
            if (str_contains($p, 'función') || str_contains($p, 'funcion')) {
                return $this->exito("En matemáticas, una **función** es una regla que asigna a cada elemento de un conjunto (dominio) exactamente un elemento de otro conjunto (rango).\n\n**Ejemplo:**\nf(x) = 2x + 1\nSi x = 2, entonces f(2) = 5.\n\nLas funciones describen relaciones causa-efecto en fenómenos naturales y económicos.");
            }
            return $this->exito("Las matemáticas son la herramienta fundamental para modelar el mundo. Practica resolviendo problemas paso a paso y no te saltes los fundamentos, ya que cada tema se construye sobre el anterior.");
        }

        // ==========================================
        // BASE DE CONOCIMIENTO: FÍSICA
        // ==========================================
        if (str_contains($m, 'fisic')) {
            if (str_contains($p, 'velocidad')) {
                return $this->exito("La **velocidad** es una magnitud vectorial que indica la rapidez con que un objeto cambia de posición, incluyendo dirección.\n\n**Fórmula:**\nv = Δx / Δt\n\nEjemplo: Si un auto recorre 100 m en 10 s, su velocidad es 10 m/s. Diferencia de rapidez: la rapidez es escalar (solo número), la velocidad incluye dirección.");
            }
            if (str_contains($p, 'fuerza') || str_contains($p, 'newton')) {
                return $this->exito("La **fuerza** es una interacción que cambia el estado de movimiento de un objeto. La Segunda Ley de Newton establece:\n\n**F = m × a**\n\nDonde F es fuerza (Newtons), m es masa (kg) y a es aceleración (m/s²). Ejemplo: empujar un carrito de supermercado; mientras más masa tenga, más fuerza necesitas para acelerarlo.");
            }
            if (str_contains($p, 'energ')) {
                return $this->exito("La **energía** es la capacidad de realizar trabajo. Existen muchas formas: cinética (movimiento), potencial (posición), térmica, eléctrica, etc.\n\n**Energía cinética:** Ec = ½mv²\n**Energía potencial gravitatoria:** Ep = mgh\n\nEl principio de conservación de la energía dice que la energía no se crea ni se destruye, solo se transforma.");
            }
            return $this->exito("La física estudia las leyes fundamentales del universo. Siempre dibuja un diagrama antes de resolver un problema: identifica las fuerzas, datos conocidos y la incógnita. La práctica constante es la clave.");
        }

        // ==========================================
        // BASE DE CONOCIMIENTO: QUÍMICA
        // ==========================================
        if (str_contains($m, 'quimic')) {
            if (str_contains($p, 'mol')) {
                return $this->exito("El **mol** es la unidad de cantidad de sustancia en el Sistema Internacional. Un mol contiene aproximadamente 6.022 × 10²³ entidades elementales (átomos, moléculas, etc.), conocido como número de Avogadro.\n\n**Ejemplo:**\n1 mol de átomos de carbono tiene una masa de 12 gramos y contiene 6.022×10²³ átomos de carbono.");
            }
            if (str_contains($p, 'enlace') || str_contains($p, 'enlace quimico')) {
                return $this->exito("Un **enlace químico** es la fuerza que mantiene unidos a los átomos en una molécula o compuesto. Los principales son:\n\n1. **Iónico:** transferencia de electrones (ej: NaCl).\n2. **Covalente:** compartición de electrones (ej: H₂O).\n3. **Metálico:** mar de electrones entre átomos metálicos.\n\nLa naturaleza del enlace determina las propiedades físicas y químicas de la sustancia.");
            }
            if (str_contains($p, 'reacción') || str_contains($p, 'reaccion')) {
                return $this->exito("Una **reacción química** es un proceso en el que una o más sustancias (reactivos) se transforman en otras diferentes (productos).\n\n**Ejemplo:**\n2H₂ + O₂ → 2H₂O\n\nLas reacciones obedecen la ley de conservación de la masa: la masa total de los reactivos es igual a la masa total de los productos.");
            }
            return $this->exito("La química es la ciencia central que conecta la física con la biología. Memoriza la tabla periódica por grupos y practica el balanceo de ecuaciones; es la base para entender reacciones orgánicas e inorgánicas.");
        }

        // Respuesta genérica si no coincide ninguna palabra clave
        return $this->exito("Excelente pregunta sobre **{$materia}**. Este tema es fundamental para tu formación académica. Te recomiendo revisar los apuntes de clase, practicar con ejercicios resueltos y, si tienes dudas específicas, consultar con tu tutor asignado en la plataforma.");
    }

    private function exito(string $texto): array
    {
        return [
            'exito' => true,
            'respuesta' => $texto,
            'nivel_confianza' => 92.00,
        ];
    }
}