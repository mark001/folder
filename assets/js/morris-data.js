$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2015 Q1',
            files: 2666,
            branches: null,
            folders: 2647
        }, {
            period: '2015 Q2',
            files: 2778,
            branches: 2294,
            folders: 2441
        }, {
            period: '2015 Q3',
            files: 4912,
            branches: 1969,
            folders: 2501
        }, {
            period: '2015 Q4',
            files: 3767,
            branches: 3597,
            folders: 5689
        }, {
            period: '2015 Q5',
            files: 6810,
            branches: 1914,
            folders: 2293
        }, {
            period: '2015 Q6',
            files: 5670,
            branches: 4293,
            folders: 1881
        }, {
            period: '2015 Q7',
            files: 4820,
            branches: 3795,
            folders: 1588
        }, {
            period: '2015 Q8',
            files: 15073,
            branches: 5967,
            folders: 5175
        }, {
            period: '2015 Q9',
            files: 10687,
            branches: 4460,
            folders: 2028
        }, {
            period: '2015 Q10',
            files: 8432,
            branches: 5713,
            folders: 1791
        }],
        xkey: 'period',
        ykeys: ['files', 'branches', 'folders'],
        labels: ['files', 'branches', 'folders'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });


});
