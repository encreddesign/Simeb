function Summ (content, keyword) {

  this.highscoring = [];
  this.sentences = ( content.length > 0 ? content.match(/(.*?)\./g) : null );

  this.extract = function () {

    var builder = [];
    var sentences = [];

    for(var i = 0; i < this.sentences.length; i++) {

      var neg = (i - 1);
      var iter1 = (neg += 1);
      var iter2 = (i += 1);

      var set1Words = this.sentences[iter1].split(' ');
      var set2Words = this.sentences[iter2].split(' ');

      builder.push( [set1Words, set2Words] );

    }

    for(var i = 0; i < builder.length; i++) {

      var sent1 = (builder[i][0]);
      var sent2 = (builder[i][1]);

      if(sent1.length > sent2.length) {

        var sentF = sent1;
        var sentL = sent2;

      } else {

        var sentF = sent2;
        var sentL = sent1;

      }

      for(var j = 0; j < sentF.length; j++) {

        if(sentL.indexOf(sentF[j]) == -1) {

          var string = sentF.join(' ');
          if(sentences.indexOf(string) == -1) sentences.push(string);

        }

      }

    }

    return { 'full' : content, 'summ' : sentences.join(' ') };

  };

  this.keywords = function (score) {

    var words = [];
    var chosen = {};
    var highscore = [];

    // Ranking of word
    var keywordScore = (score ? score : 1);

    for(var i = 0; i < this.sentences.length; i++) {

      var word = this.sentences[i].match(/(\w{6,20})/g);

      if(word && word.length > 0) {

        for(var j = 0; j < word.length; j++) {

          words.push(word[j]);

        }

      }

    }

    for(var i = 0; i < words.length; i++) {

      if(chosen[words[i]] != null) {

        chosen[words[i]] += 1;

      } else { chosen[words[i]] = 1; }

      if(chosen[words[i]] > keywordScore && highscore.indexOf(words[i]) == -1) highscore.push(words[i]);

    }

    this.highscoring = highscore;
    return this.highscoring;

  };

  this.extractOffKeywords = function (cap) {

    var extracted = [];

    if(this.highscoring.length == 0) this.keywords();

    for(var i = 0; i < this.sentences.length; i++) {

      var words = this.sentences[i].split(' ');
      for(var j = 0; j < this.highscoring.length; j++) {

        if(words.indexOf(this.highscoring[j]) != -1 && extracted.indexOf(this.sentences[i].trim()) == -1) {

          extracted.push(this.sentences[i].trim());

        }

      }

    }

    return (cap ? extracted.slice(0, cap) : extracted);

  };

}

window.onload = function () {

  var summ = new Summ(document.getElementById('content').innerText, null);

  summ.keywords();
  var refined = summ.extractOffKeywords(4).join(' ');

  document.getElementById('content').innerHTML = summ.extract().full + '<br><br><p>Full char length: ' + summ.extract().full.length + '</p>';
  document.getElementById('summed').innerHTML = summ.extract().summ + '<br><br><p>Summed char length: ' + summ.extract().summ.length + '</p>';
  document.getElementById('summed-ref').innerHTML = refined + '<br><br><p>Summed refine char length: ' + refined.length + '</p>';

};
