'use strict';
var data = require('./data-2027.json');

function regionCode(region) {
  if (!region) return null;
  var r = String(region).toUpperCase();
  if (data.regions[r]) return r;
  if (data.regions['ES-' + r]) return 'ES-' + r;
  var norm = function (x) { return String(x).toUpperCase().normalize('NFD').replace(/[\u0300-\u036f]/g, ''); };
  var n = norm(r);
  var keys = Object.keys(data.regions);
  for (var i = 0; i < keys.length; i++) {
    var name = norm(data.regions[keys[i]].name);
    if (name === n || name.indexOf(n) !== -1) return keys[i];
  }
  return null;
}

function national() {
  return data.national.slice();
}

function regions() {
  return Object.keys(data.regions).map(function (k) {
    return { code: k, name: data.regions[k].name };
  });
}

function holidays(region) {
  if (!region) return national();
  var code = regionCode(region);
  if (!code) throw new Error('Unknown region: ' + region);
  return data.regions[code].holidays.slice();
}

function source(region) {
  var code = regionCode(region);
  if (!code) throw new Error('Unknown region: ' + region);
  return data.regions[code].source;
}

function isHoliday(date, region) {
  var d = date instanceof Date ? date.toISOString().slice(0, 10) : String(date).slice(0, 10);
  var list = holidays(region);
  for (var i = 0; i < list.length; i++) if (list[i].date === d) return list[i];
  return null;
}

function nextHoliday(region, from) {
  var start = from ? (from instanceof Date ? from.toISOString().slice(0, 10) : String(from).slice(0, 10)) : new Date().toISOString().slice(0, 10);
  var list = holidays(region);
  for (var i = 0; i < list.length; i++) if (list[i].date >= start) return list[i];
  return null;
}

module.exports = { year: data.year, national: national, regions: regions, holidays: holidays, source: source, isHoliday: isHoliday, nextHoliday: nextHoliday, data: data };
