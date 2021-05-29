<?php

namespace App\Repositories\Contracts;

interface DosenRepository
{
    public function store($data);
    public function storeKalab($data);
    public function storeKaprodi($data);
    public function deleteDosen($id);
    public function deleteKalab($id);
    public function deleteKaprodi($id);
    public function getById($id);
    public function getByIdNotNull($id);
    public function getByJurusan($jurusan_id);
    public function getByFakultas($fakultas_id);
    public function getByRmk($rmk_id);
    public function getByProgramStudiAndJurusan($jurusan_id, $program_studi_id);
    public function getKaprodiByJurusan($jurusan_id);
    public function getKaprodiByDosenId($id);
    public function getKaprodisByAll($jurusan_id, $program_studi_id);
    public function getKalabsByRmk($rmk_id);
    public function getKalabsByDosenId($id);
}
