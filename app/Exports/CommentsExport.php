<?php
namespace App\Exports;
use App\Models\Comment;
use App\Models\Building;
use App\Exports\Sheets\CommentsByBuildingSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CommentsExport implements WithMultipleSheets
{
  /**
   * @return array
   */
  public function sheets(): array
  {
    $sheets = [];
    $buildings = Building::with('comments')->orderBy('title')->get();
    foreach($buildings as $building)
    {
      if ($building->comments->count() > 0)
      {
        $sheets[] = new CommentsByBuildingSheet($building);
      }
    }
    return $sheets;
  }

}
