<?php

    namespace App\Entidades;

    use Illuminate\Database\Eloquent\Model;

    class Datos extends Model
    {
        protected $table = 'view_datos';

        public function scopePorMedicion( $query, $medicion_id ) {
            return $query->where('municipio_campo_id', $medicion_id);
        }

        public function scopePorUsuario( $query, $user_id ) {
            return $query->where('user_id', $user_id);
        }
    }