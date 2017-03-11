<?php

namespace App\Http\Controllers;

class SpecializedTwo extends Controller {

  protected function getS():bool {
      $A = $this->a;
      $B = $this->b;
      $C = $this->c;

      $res = $A && !$B && $C;
      if ($res) {
          $D = $this->d;
          $E = $this->e;
          $F = $this->f;
          $this->y = $F + $D + ( $D * $E / 100 );
      }
      return $res;
  }
  
  protected function getT():bool {
      $A = $this->a;
      $B = $this->b;
      $C = $this->c;

      $res = $A && $B && !$C;
      if ($res) {
          $D = $this->d;
          $F = $this->f;
          $this->y = $D - ( $D * $F / 100 );
      }
      return $res;
  }

}
