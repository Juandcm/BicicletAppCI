<?php

/**
 * Session language strings.
 *
 * @package    CodeIgniter
 * @author     Kenny Saenz
 * @copyright  2019 
 * @link       https://github.com/kenny1504/CodeIgniter_4-Spanish-Pack
 * @since      Version 4.0.0 Beta 3
 * @filesource
 *
 * @codeCoverageIgnore
 */

return [
   'missingDatabaseTable'   => '`sessionSavePath` debe tener el nombre de la tabla para que funcione el controlador de sesión de base de datos.',
   'invalidSavePath'        => "Session: Ruta de guardado configurada '{0}' no es un directorio, no existe o no se puede crear.",
   'writeProtectedSavePath' => "Session: Ruta de guardado configurada '{0}' no es editable por el proceso PHP.",
   'emptySavePath'          => 'Session: Sin guardar ruta configurada.',
   'invalidSavePathFormat'  => 'Session: Formato de ruta de guardado de Redis no válido: {0}',
];
