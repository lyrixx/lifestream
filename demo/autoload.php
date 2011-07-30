<?php

spl_autoload_register(function($class) {
    if (0 === strpos($class, 'Lifestream\\'))
    {
      $file = __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php';
      if (file_exists($file))
      {
        require_once $file;
        return true;
      }
    }
    elseif (0 === strpos($class, 'Buzz\\') || 0 === strpos($class, '\Buzz\\'))
    {
      $file = __DIR__ . '/../vendor/Buzz/lib/' . str_replace('\\', '/', $class) . '.php';
      if (file_exists($file))
      {
        require_once $file;
        return true;
      }
    }
  });
