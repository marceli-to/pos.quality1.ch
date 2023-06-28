<?php
namespace App\Exports\Sheets;
use App\Models\Comment;
use App\Models\Building;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CommentsByBuildingSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
  private $building;

  public function __construct(Building $building)
  {
    $this->building = $building;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $comments = Comment::where('building_id', '=', $this->building->id)->withTrashed()->get();
    $data = [];
    foreach($comments as $c)
    {
      $data[] = [
        'Datum' => $c->dateExport,
        'Kommentar' => $c->comment,
        'Publiziert' => $c->publish == 1 && $c->deleted_at == NULL ? 'Ja' : 'Nein',
        'Gelöscht' => $c->deleted_at != NULL ? 'Ja' : 'Nein'
      ];
    }
    return collect($data);
  }

  public function headings(): array
  {
    return [
      'Datum',
      'Kommentar',
      'Publiziert',
      'Gelöscht'
    ];
  }

  public function title(): string
  {
    return $this->building->title;
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true]],
    ];
  }

}