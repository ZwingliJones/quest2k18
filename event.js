function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
  var angleInRadians = (angleInDegrees - 90) * Math.PI / 180;

  return {
    x: centerX + (radius * Math.cos(angleInRadians)),
    y: centerY + (radius * Math.sin(angleInRadians))
  };
}

function drawArc(x, y, radius, startAngle, endAngle){
  var start = polarToCartesian(x, y, radius, endAngle),
      end = polarToCartesian(x, y, radius, startAngle),
      arcSweep = endAngle - startAngle <= 180 ? "0" : "1",
      d = [
        "M", start.x, start.y,
        "A", radius, radius, 0, arcSweep, 0, end.x, end.y
      ].join(" ");
  return d;
}

function textArc(x, y, radius, startAngle, endAngle, clockwise) {
  var start = polarToCartesian(x, y, radius, startAngle),
      end = polarToCartesian(x, y, radius, endAngle),
      arcSweep = endAngle - startAngle <= 180 ? "0" : "1",
      d = [
        "M", start.x, start.y,
        "A", radius, radius, 0, arcSweep, 1, end.x, end.y
      ].join(" ");
  return d;
}

$(function() {
  var $svg = $('svg'),
      $defs = $('defs'),
      $path = $('svg > path'),
      $text_path = null,
      x = ($('svg').width() / 2),
      y = x,
      r = x,
      total = $path.length,
      degree_padding = 6,
      sector = (360 / total),
      active_index = 0;
  
  $.each($path, function(i, el) {
    var $p = $(el),
        start_stroke_angle = (i * sector),
        end_stroke_angle = ((start_stroke_angle - degree_padding) + sector),
        start_text_angle = (sector * i),
        end_text_angle =  (sector * (i + 1)),
        id = (i + 1),
        label = $p.attr('data-label');
    
    // Set id and draw path
    $p.attr('d', drawArc(x, y, r, start_stroke_angle, end_stroke_angle));
    
    // Set defs
    var def_path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    def_path.setAttributeNS(null, 'id', 'text-path-' + id);
    $(def_path).attr('d', textArc(x, y, (r - 30), start_text_angle, end_text_angle));
    $defs.append($(def_path));
    
    // Set <text>
    var text = document.createElementNS("http://www.w3.org/2000/svg", "text");
    
    // Set <textPath>
    var text_path = document.createElementNS("http://www.w3.org/2000/svg", "textPath");
    text_path.setAttributeNS(null, 'startOffset', '50%');
    text_path.setAttributeNS(null, "text-anchor", "middle");
    text_path.setAttributeNS(null, 'dominant-baseline', 'center');
    text_path.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", "#text-path-" + id);
    
    var data = document.createTextNode(label);
    
    text_path.appendChild(data);
    $svg.append($(text).append(text_path));
  });
  
  var $text = $('text');
  
  // Now click anywhere to cyle through and update progress
  $('body').on('click', onClick);
  
  // Listen for click, update chart
  function onClick() {
    if (active_index < total) {
      for (var i = 0; i < $path.length; i++) {
        if (i < active_index) {
          $path.eq(i).attr('class', 'complete');
          $text.eq(i).attr('class', 'active');
        }
      }
    }
    
    if (active_index === total) {
      $path.attr('class', '');
      $text.attr('class', '');
    }
    
    $path.eq(active_index).attr('class', 'active');
    
    if (active_index < total) {
      active_index++;
    } else {
      active_index = 0;
    }
  };
});