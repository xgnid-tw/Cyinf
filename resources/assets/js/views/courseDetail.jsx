import React from 'react';
import CourseDetailPartial from '../layout/courseDetailPartial';
import mainLayout from '../layout/mainLayout';

let CourseDetail = React.createClass({
  'getInitialState': function () {
    return {
      'courseName': 'Nana Mizuki Live Adventure',
      'teacher': '水樹奈奈',
      'room': '工EC 5012',
      'schedule': '一 67, 二 8',
      'department': '音樂系',
      'credit': 10
    };
  },
  'render': function () {
    return (
      <div id="container">
        <CourseDetailPartial {...this.state} />
      </div>
    );
  }
});

mainLayout(CourseDetail);
