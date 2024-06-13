import React, { Component } from 'react';
import { Line } from 'react-chartjs-2';
import { Link } from 'react-router-dom';


function randomScalingFactor() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}

const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
        {
            label: 'Profit',
            borderColor: '#f3f3f3',
            backgroundColor: '#f3f3f3',
            fill: true,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            yAxisID: 'y-axis-1'
        }, {
            label: 'Revenue',
            borderColor: '#28166F',
            backgroundColor: '#28166F',
            fill: true,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            yAxisID: 'y-axis-2'
        }
    ],
};

const options = {
    responsive: true,
    stacked: true,
    title: {
        display: false,
    },
    scales: {
        yAxes: [
            {
                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                display: true,
                position: 'left',
                id: 'y-axis-1'
            }, {
                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                display: true,
                position: 'right',
                id: 'y-axis-2',

                // grid line settings
                gridLines: {
                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                }
            }
        ]
    }
};

class Detailchart extends Component {
    render() {
        return (
            <div className="section">
                <div className="row align-items-center">
                    <div className="col-lg-6">
                        <div className="sigma_canvas">
                            <Line data={data} options={options} />
                        </div>
                    </div>
                    <div className="col-lg-6">
                        <div className="mr-lg-30">
                            <div className="section-title mb-0 text-left">
                                <p className="subtitle">Benefits</p>
                                <h4 className="title">Best Market Around</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <Link to="#">Lorem
                                    Ipsum has</Link> been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type
                                    specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Detailchart;