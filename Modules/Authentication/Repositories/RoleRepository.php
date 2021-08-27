<?php

namespace Authentication\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function update_permissions(array $attributes, $id);
}
