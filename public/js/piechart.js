function textAnswers(id, survey, rowJson) {
  
  // create data
  survey = `[\n\t${survey}\n]`;
  rowJson = `[\n\t${rowJson}\n]`;
  var surveyLength = JSON.parse(survey); // number of questions in survey
  var rowJson2 = JSON.parse(rowJson); // all answers

  var title = document.getElementById(`card-title-${id}`).innerHTML;
  var answers = new Array();
  var tmp = new Array();
  var stock = new Array();
  var users = 0;

  // find duplicates
  for(j = 0; j < rowJson2.length; j++) {
      if(rowJson2[j]["Question"] == title) {
          stock[users] = rowJson2[j]["Answer"]; users++;
      }
  }
  
  dataString = "{";
  var values = {};
  var tmp;

  for(i = 0; i < stock.length; i++) {
    tmp = stock[i];
    if(tmp in values) {
        values[tmp]++;
    }
    else {
        values[tmp] = 1;
    }
  }
  
  for(value in values) {
      dataString = dataString.concat(`\"${value}\":\"${values[value]}\",`);
  }
  
  dataString = dataString.substring(0, dataString.length - 1).concat("}");
  
  var data = JSON.parse(dataString);

  if (Object.keys(data).length < 4) {
    for(i = 0; i < Object.keys(data).length; i++) {
      $(`#text_dataviz${id}`).append(`<p class="card-text analyze-text" style="margin-bottom: 0; font-size: 20px !important; font-weight: medium !important; margin-right: 5rem !important;">- ${Object.keys(data)[i]}</p>`);
    }
  } else {
    for(i = 0; i < 3; i++) {
      $(`#text_dataviz${id}`).append(`<p class="card-text analyze-text" style="margin-bottom: 0; font-size: 20px !important; font-weight: medium !important; margin-right: 5rem !important;">- ${Object.keys(data)[i]}</p>`);
    }
  }

  if (Object.keys(data).length >= 4) {
    for(i = 3; i < Object.keys(data).length; i++) {
      $(`#full_text_dataviz${id}`).append(`<p class="card-text analyze-text" style="margin-bottom: 0; font-size: 20px !important; font-weight: medium !important; margin-right: 5rem !important;">- ${Object.keys(data)[i]}</p>`);
    }
  }
}

function piechartRadio(id, survey, rowJson) {
  // set the dimensions and margins of the graph
  var width = 333
      height = 333
      margin = 40

  // The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
  var radius = Math.min(width, height) / 2 - margin

  // append the svg object to the div called 'my_dataviz+id'
  var svg = d3.select(`#my_dataviz${id}`)
    .append("svg")
      .attr("width", width)
      .attr("height", height)
    .append("g")
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

  // create data
  survey = `[\n\t${survey}\n]`;
  rowJson = `[\n\t${rowJson}\n]`;
  var surveyLength = JSON.parse(survey); // number of questions in survey
  var rowJson2 = JSON.parse(rowJson); // all answers

  var title = document.getElementById(`card-title-${id}`).innerHTML;
  var answers = new Array();
  var tmp = new Array();
  var stock = new Array();
  var users = 0;

  // find duplicates
  for(j = 0; j < rowJson2.length; j++) {
      if(rowJson2[j]["Question"] == title) {
          stock[users] = rowJson2[j]["Answer"]; users++;
      }
  }
  
  dataString = "{";
  var values = {};
  var tmp;

  for(i = 0; i < stock.length; i++) {
    tmp = stock[i];
    if(tmp in values) {
        values[tmp]++;
    }
    else {
        values[tmp] = 1;
    }
  }
  
  for(value in values) {
      dataString = dataString.concat(`\"${value}: ${values[value]}\":\"${values[value]}\",`);
  }
  
  dataString = dataString.substring(0, dataString.length - 1).concat("}");

  var data = JSON.parse(dataString);

  // set the color scale
  var color = d3.scaleOrdinal()
    .domain(data)
    .range(d3.schemeSet2);

  // Compute the position of each group on the pie:
  var pie = d3.pie()
    .value(function(d) {return d.value; })
  var data_ready = pie(d3.entries(data))
  // Now I know that group A goes from 0 degrees to x degrees and so on.

  // shape helper to build arcs:
  var arcGenerator = d3.arc()
    .innerRadius(0)
    .outerRadius(radius)

  // Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
  svg
    .selectAll('mySlices')
    .data(data_ready)
    .enter()
    .append('path')
      .attr('d', arcGenerator)
      .attr('fill', function(d){ return(color(d.data.key)) })
      .attr("stroke", "#333333")
      .style("stroke-width", "1px")
      .style("opacity", 0.75)

  // Now add the annotation. Use the centroid method to get the best coordinates
  svg
    .selectAll('mySlices')
    .data(data_ready)
    .enter()
    .append('text')
    .text(function(d){ return d.data.key})
    .attr("transform", function(d) { return "translate(" + arcGenerator.centroid(d) + ")";  })
    .style("text-anchor", "middle")
    .style("font-size", 15)
}

function piechartCheckbox(id, survey, rowJson) {
  // set the dimensions and margins of the graph
  var width = 333
      height = 333
      margin = 40

  // The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
  var radius = Math.min(width, height) / 2 - margin

  // append the svg object to the div called 'my_dataviz+id'
  var svg = d3.select(`#my_dataviz${id}`)
    .append("svg")
      .attr("width", width)
      .attr("height", height)
    .append("g")
      .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

  // create data
  survey = `[\n\t${survey}\n]`;
  rowJson = `[\n\t${rowJson}\n]`;
  var surveyLength = JSON.parse(survey); // number of questions in survey
  var rowJson2 = JSON.parse(rowJson); // all answers

  var title = document.getElementById(`card-title-${id}`).innerHTML;
  var answers = new Array();
  var tmp = new Array();
  var stock = new Array();
  var users = 0;

  // find duplicates
  for(j = 0; j < rowJson2.length; j++) {
      if(rowJson2[j]["Question"] == title) {
          stock[users] = rowJson2[j]["Answer"]; users++;
      }
  }
  
  dataString = "{";
  var checkboxSplit = new Array();

  for(i = 0; i < stock.length; i++) {
    if(stock[i].includes(",")) {
      checkboxSplit[i] = stock[i].split(",");
    }
  }

  var checkboxArray = [];
  for(i = 0; i < checkboxSplit.length; i++) {
    checkboxArray = checkboxArray.concat(checkboxSplit[i]);
  }

  dataString = "{";
  var values = {};
  var tmp;

  for(i = 0; i < checkboxArray.length; i++) {
    tmp = checkboxArray[i];
    if(tmp in values) {
        values[tmp]++;
    }
    else {
        values[tmp] = 1;
    }
  }
  
  for(value in values) {
      dataString = dataString.concat(`\"${value}: ${values[value]}\":\"${values[value]}\",`);
  }
  
  dataString = dataString.substring(0, dataString.length - 1).concat("}");

  var data = JSON.parse(dataString);

  // set the color scale
  var color = d3.scaleOrdinal()
    .domain(data)
    .range(d3.schemeSet2);

  // Compute the position of each group on the pie:
  var pie = d3.pie()
    .value(function(d) {return d.value; })
  var data_ready = pie(d3.entries(data))
  // Now I know that group A goes from 0 degrees to x degrees and so on.

  // shape helper to build arcs:
  var arcGenerator = d3.arc()
    .innerRadius(0)
    .outerRadius(radius)

  // Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
  svg
    .selectAll('mySlices')
    .data(data_ready)
    .enter()
    .append('path')
      .attr('d', arcGenerator)
      .attr('fill', function(d){ return(color(d.data.key)) })
      .attr("stroke", "#333333")
      .style("stroke-width", "1px")
      .style("opacity", 0.75)

  // Now add the annotation. Use the centroid method to get the best coordinates
  svg
    .selectAll('mySlices')
    .data(data_ready)
    .enter()
    .append('text')
    .text(function(d){ return d.data.key})
    .attr("transform", function(d) { return "translate(" + arcGenerator.centroid(d) + ")";  })
    .style("text-anchor", "middle")
    .style("font-size", 15)
}