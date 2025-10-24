<?php
namespace App;

enum ComplaintStatus: string {
    case Pending    = 'Pending';
    case InProgress = 'In Progress';
    case Resolved   = 'Resolved';
}
