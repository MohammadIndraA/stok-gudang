<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectStages;
use App\Models\Vendor;

class ProjectStagesRepository
{
    public function all()
    {
        return ProjectStages::latest()->get();
    }

    public function find($id)
    {
        return ProjectStages::with(['items.material'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return ProjectStages::create($data);
    }

    public function update(ProjectStages $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    public function delete(ProjectStages $project)
    {
        return $project->delete();
    }
}
