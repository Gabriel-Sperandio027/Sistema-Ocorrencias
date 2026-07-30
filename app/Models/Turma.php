<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'nome',
        'curso',
        'ano_letivo',
        'turno',
    ];

    /**
     * Relacionamento: Uma turma possui muitos alunos.
     */
    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    /**
     * Relacionamento: Uma turma possui muitas ocorrências através dos alunos.
     */
    public function ocorrencias()
    {
        return $this->hasManyThrough(Ocorrencia::class, Aluno::class);
    }
}