<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController {

  private function cast($var, $type) {
    if ($var) {
      switch($type) {
        case "bool": return filter_var($var, \FILTER_VALIDATE_BOOLEAN);
        case "int": return filter_var($var, \FILTER_VALIDATE_INT);
      }
    }
    return null;
  }

  protected function getS():bool {
    $A = $this->a;
    $B = $this->b;
    $C = $this->c;

    $res = $A && $B && !$C;
    if ($res) {
        $D = $this->d;
        $E = $this->e;
        $this->y = $D + ( $D * $E / 100 );
    }
    return $res;
  }

  protected function getR():bool {
    $A = $this->a;
    $B = $this->b;
    $C = $this->c;

    $res = $A && $B && $C;
    if ($res) {
      $D = $this->d;
      $E = $this->e;
      $F = $this->f;
      $this->y = $D + ( $D * ( $E - $F ) / 100 );
    }
    return $res;
  }

  protected function getT():bool {
    $A = $this->a;
    $B = $this->b;
    $C = $this->c;

    $res = !$A && $B && $C;
    if ($res) {
      $D = $this->d;
      $F = $this->f;
      $this->y = $D - ( $D * $F / 100 );
    }
    return $res;
  }

  public function getX(bool $A, bool $B, bool $C, int $D, int $E, int $F):array {
    $this->a = $A;
    $this->b = $B;
    $this->c = $C;
    $this->d = $D;
    $this->e = $E;
    $this->f = $F;

    $S = $this->getS();
    $R = $this->getR();
    $T = $this->getT();

    if (!$S && !$R && !$T) {
      throw new \Exception('Invalid input for a, b, or c');
    }
    return array($S, $R, $T);
  }

  public function getY():float {
    return $this->y;
  }

  function getResult(Request $request):\Illuminate\Http\JsonResponse {
    $A = $this->cast($request->input('a'), 'bool');
    $B = $this->cast($request->input('b'), 'bool');
    $C = $this->cast($request->input('c'), 'bool');
    $D = $this->cast($request->input('d'), 'int');
    $E = $this->cast($request->input('e'), 'int');
    $F = $this->cast($request->input('f'), 'int');

    try {
      $X = $this->getX($A, $B, $C, $D, $E, $F);
      $Y = $this->getY();
      return response()->json(["X" => $X, "Y" => $Y]);
    } catch(\TypeError $e) {
      return response()->json(["error" => true, "msg" => $e->getMessage()]);
    } catch(\Throwable $e) {
      return response()->json(["error" => true, "msg" => $e->getMessage()]);
    }
  }
}
